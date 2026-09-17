<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Biaya;
use App\Models\Mahasiswa;
use App\Models\Mahasiswa_paymant;
use App\Models\ProgramOption;
use App\Models\RegistrationPath;
use App\Models\Departement;

class PembayaranTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Biaya $biaya;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'name'              => 'Test User',
            'email'             => 'test@bth.ac.id',
            'phone'             => '081234567890',
            'role'              => 'Customer',
            'email_verified_at' => now(),
        ]);

        $this->biaya = Biaya::create([
            'biaya'       => 'Registrasi / Daftar Ulang Jalur Reguler',
            'description' => 'Biaya her-registrasi',
            'nominal'     => 1000000,
            'type'        => 'Tunai',
            'status'      => 'Publish',
        ]);
    }

    // =====================================================================
    // storePaymant Tests
    // =====================================================================

    /** @test */
    public function store_paymant_sukses_generate_va()
    {
        Http::fake([
            '*duitku*' => Http::response([
                'merchantCode' => 'D20322',
                'reference'    => 'REF123',
                'paymentUrl'   => 'https://passport.duitku.com/pay/TEST',
                'vaNumber'     => '1234567890',
                'amount'       => '1003000',
                'statusCode'   => '00',
                'statusMessage' => 'SUCCESS',
            ], 200),
        ]);

        $response = $this->actingAs($this->user)->post(route('paymant.pay'), [
            'biaya_id'       => $this->biaya->id,
            'payment_method' => 'BR',
        ]);

        // Redirect ke payment URL Duitku
        $response->assertRedirect('https://passport.duitku.com/pay/TEST');

        // Record pending terbuat di DB
        $this->assertDatabaseHas('mahasiswa_paymants', [
            'user_id'  => $this->user->id,
            'biaya_id' => $this->biaya->id,
            'status'   => 'pending',
            'amount'   => 1000000,
        ]);
    }

    /** @test */
    public function store_paymant_auto_expired_pending_lama_sebelum_buat_baru()
    {
        // Buat pending lama
        $pendingLama = Mahasiswa_paymant::create([
            'user_id'           => $this->user->id,
            'biaya_id'          => $this->biaya->id,
            'merchant_order_id' => 'OLD-ORDER-123',
            'payment_method'    => 'I1',
            'amount'            => 1000000,
            'status'            => 'pending',
        ]);

        Http::fake([
            '*duitku*' => Http::response([
                'paymentUrl' => 'https://passport.duitku.com/pay/NEW',
                'statusCode' => '00',
            ], 200),
        ]);

        $this->actingAs($this->user)->post(route('paymant.pay'), [
            'biaya_id'       => $this->biaya->id,
            'payment_method' => 'BR',
        ]);

        // Pending lama harus EXPIRED
        $this->assertDatabaseHas('mahasiswa_paymants', [
            'id'     => $pendingLama->id,
            'status' => 'EXPIRED',
        ]);

        // Record baru dengan status pending terbuat
        $this->assertDatabaseHas('mahasiswa_paymants', [
            'user_id'        => $this->user->id,
            'biaya_id'       => $this->biaya->id,
            'status'         => 'pending',
            'payment_method' => 'BR',
        ]);
    }

    /** @test */
    public function store_paymant_biaya_tidak_ditemukan_redirect_back_with_error()
    {
        $response = $this->actingAs($this->user)->post(route('paymant.pay'), [
            'biaya_id'       => 9999,
            'payment_method' => 'BR',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error');

        // Tidak ada record pending terbuat
        $this->assertDatabaseMissing('mahasiswa_paymants', [
            'user_id' => $this->user->id,
        ]);
    }

    /** @test */
    public function store_paymant_duitku_gagal_record_dihapus_tidak_ada_pending_menggantung()
    {
        Http::fake([
            '*duitku*' => Http::response(['error' => 'Server Error'], 500),
        ]);

        $response = $this->actingAs($this->user)->post(route('paymant.pay'), [
            'biaya_id'       => $this->biaya->id,
            'payment_method' => 'BR',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error');

        // Tidak ada record pending yang tersisa
        $this->assertDatabaseMissing('mahasiswa_paymants', [
            'user_id'  => $this->user->id,
            'biaya_id' => $this->biaya->id,
            'status'   => 'pending',
        ]);
    }

    /** @test */
    public function store_paymant_merchant_order_id_unik_setiap_kali_buat_transaksi()
    {
        Http::fake([
            '*duitku*' => Http::response([
                'paymentUrl' => 'https://passport.duitku.com/pay/TEST',
                'statusCode' => '00',
            ], 200),
        ]);

        $this->actingAs($this->user)->post(route('paymant.pay'), [
            'biaya_id'       => $this->biaya->id,
            'payment_method' => 'BR',
        ]);

        $biaya2 = Biaya::create([
            'biaya'       => 'Biaya Lain',
            'description' => 'Test',
            'nominal'     => 500000,
            'type'        => 'Tunai',
            'status'      => 'Publish',
        ]);

        $this->actingAs($this->user)->post(route('paymant.pay'), [
            'biaya_id'       => $biaya2->id,
            'payment_method' => 'BR',
        ]);

        $orders = Mahasiswa_paymant::where('user_id', $this->user->id)
            ->whereNotNull('merchant_order_id')
            ->pluck('merchant_order_id')
            ->toArray();

        // Semua merchant_order_id harus unik
        $this->assertEquals(count($orders), count(array_unique($orders)));
    }

    // =====================================================================
    // Callback Tests
    // =====================================================================

    /** @test */
    public function callback_signature_valid_status_success_update_db_dan_generate_nim()
    {
        $departement = Departement::first() ?? Departement::create([
            'faculty_id'  => 1,
            'name'        => 'D3 Keperawatan',
            'description' => 'Test',
            'status'      => 'active',
        ]);

        $registrationPath = RegistrationPath::first() ?? RegistrationPath::create([
            'name'       => 'Gelombang 2',
            'title'      => 'Test',
            'description' => 'Test',
            'image'      => 'test.jpg',
            'start_date' => now(),
            'end_date'   => now()->addMonth(),
            'amount'     => 300000,
            'status'     => 'open',
        ]);

        // Buat program option dengan status Daftar Ulang
        ProgramOption::create([
            'user_id'              => $this->user->id,
            'registration_path_id' => $registrationPath->id,
            'departement_id'       => $departement->id,
            'program_option'       => 1,
            'status'               => 'Daftar Ulang',
        ]);

        $paymant = Mahasiswa_paymant::create([
            'user_id'           => $this->user->id,
            'biaya_id'          => $this->biaya->id,
            'merchant_order_id' => 'ORDER-CALLBACK-001',
            'payment_method'    => 'BR',
            'amount'            => 1000000,
            'status'            => 'pending',
        ]);

        $merchantCode = 'D20322';
        $apiKey       = '9b468d49ff1b8b86d9368b92dd85cd51';
        $amount       = '1000000';
        $merchantOrderId = 'ORDER-CALLBACK-001';
        $signature    = md5($merchantCode . $amount . $merchantOrderId . $apiKey);

        $response = $this->post(route('paymant.her.callback'), [
            'merchantCode'   => $merchantCode,
            'amount'         => $amount,
            'merchantOrderId' => $merchantOrderId,
            'signature'      => $signature,
            'paymentCode'    => 'BR',
            'resultCode'     => '00',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Payment status updated']);

        // Status pembayaran harus SUCCESS
        $this->assertDatabaseHas('mahasiswa_paymants', [
            'id'     => $paymant->id,
            'status' => 'SUCCESS',
        ]);

        // Program option Daftar Ulang harus jadi Generate NIM
        $this->assertDatabaseHas('program_options', [
            'user_id' => $this->user->id,
            'status'  => 'Generate NIM',
        ]);
    }

    /** @test */
    public function callback_signature_tidak_valid_return_400()
    {
        $response = $this->post(route('paymant.her.callback'), [
            'merchantCode'   => 'D20322',
            'amount'         => '1000000',
            'merchantOrderId' => 'ORDER-123',
            'signature'      => 'INVALID_SIGNATURE',
            'resultCode'     => '00',
        ]);

        $response->assertStatus(400);
        $response->assertJson(['error' => 'Invalid signature']);
    }

    /** @test */
    public function callback_merchant_order_tidak_ditemukan_return_404()
    {
        $merchantCode    = 'D20322';
        $apiKey          = '9b468d49ff1b8b86d9368b92dd85cd51';
        $amount          = '1000000';
        $merchantOrderId = 'ORDER-TIDAK-ADA';
        $signature       = md5($merchantCode . $amount . $merchantOrderId . $apiKey);

        $response = $this->post(route('paymant.her.callback'), [
            'merchantCode'   => $merchantCode,
            'amount'         => $amount,
            'merchantOrderId' => $merchantOrderId,
            'signature'      => $signature,
            'resultCode'     => '00',
        ]);

        $response->assertStatus(404);
    }

    /** @test */
    public function callback_hanya_update_program_option_daftar_ulang_bukan_semua()
    {
        $departement = Departement::first() ?? Departement::create([
            'faculty_id'  => 1,
            'name'        => 'D3 Keperawatan',
            'description' => 'Test',
            'status'      => 'active',
        ]);

        $registrationPath = RegistrationPath::first() ?? RegistrationPath::create([
            'name'        => 'Gelombang 2',
            'title'       => 'Test',
            'description' => 'Test',
            'image'       => 'test.jpg',
            'start_date'  => now(),
            'end_date'    => now()->addMonth(),
            'amount'      => 300000,
            'status'      => 'open',
        ]);

        // Program option Daftar Ulang
        $poDaftarUlang = ProgramOption::create([
            'user_id'              => $this->user->id,
            'registration_path_id' => $registrationPath->id,
            'departement_id'       => $departement->id,
            'program_option'       => 1,
            'status'               => 'Daftar Ulang',
        ]);

        // Program option lain yang BUKAN Daftar Ulang
        $poLain = ProgramOption::create([
            'user_id'              => $this->user->id,
            'registration_path_id' => $registrationPath->id,
            'departement_id'       => $departement->id,
            'program_option'       => 2,
            'status'               => 'Pembayaran',
        ]);

        $paymant = Mahasiswa_paymant::create([
            'user_id'           => $this->user->id,
            'biaya_id'          => $this->biaya->id,
            'merchant_order_id' => 'ORDER-SELECTIVE-001',
            'payment_method'    => 'BR',
            'amount'            => 1000000,
            'status'            => 'pending',
        ]);

        $merchantCode    = 'D20322';
        $apiKey          = '9b468d49ff1b8b86d9368b92dd85cd51';
        $amount          = '1000000';
        $merchantOrderId = 'ORDER-SELECTIVE-001';
        $signature       = md5($merchantCode . $amount . $merchantOrderId . $apiKey);

        $this->post(route('paymant.her.callback'), [
            'merchantCode'   => $merchantCode,
            'amount'         => $amount,
            'merchantOrderId' => $merchantOrderId,
            'signature'      => $signature,
            'paymentCode'    => 'BR',
            'resultCode'     => '00',
        ]);

        // Yang Daftar Ulang ? Generate NIM
        $this->assertDatabaseHas('program_options', [
            'id'     => $poDaftarUlang->id,
            'status' => 'Generate NIM',
        ]);

        // Yang Pembayaran ? TIDAK berubah
        $this->assertDatabaseHas('program_options', [
            'id'     => $poLain->id,
            'status' => 'Pembayaran',
        ]);
    }

    // =====================================================================
    // retryPayment Tests
    // =====================================================================

    /** @test */
    public function retry_payment_berhasil_generate_va_baru()
    {
        $paymant = Mahasiswa_paymant::create([
            'user_id'           => $this->user->id,
            'biaya_id'          => $this->biaya->id,
            'merchant_order_id' => 'ORDER-EXPIRED-001',
            'payment_method'    => 'BR',
            'amount'            => 1000000,
            'status'            => 'EXPIRED',
        ]);

        Http::fake([
            '*duitku*' => Http::response([
                'paymentUrl' => 'https://passport.duitku.com/pay/RETRY',
                'statusCode' => '00',
            ], 200),
        ]);

        $response = $this->actingAs($this->user)
            ->get(route('paymant.rety.pembayaran', $paymant->id));

        $response->assertRedirect('https://passport.duitku.com/pay/RETRY');

        // Status harus pending dengan merchant order ID baru
        $paymant->refresh();
        $this->assertEquals('pending', $paymant->status);
        $this->assertNotEquals('ORDER-EXPIRED-001', $paymant->merchant_order_id);
    }

    /** @test */
    public function retry_payment_record_tidak_ditemukan_redirect_back_error()
    {
        $response = $this->actingAs($this->user)
            ->get(route('paymant.rety.pembayaran', 9999));

        $response->assertRedirect();
        $response->assertSessionHas('error');
    }

    /** @test */
    public function retry_payment_record_bukan_milik_user_ditolak()
    {
        $userLain = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $paymantUserLain = Mahasiswa_paymant::create([
            'user_id'           => $userLain->id,
            'biaya_id'          => $this->biaya->id,
            'merchant_order_id' => 'ORDER-USER-LAIN',
            'payment_method'    => 'BR',
            'amount'            => 1000000,
            'status'            => 'EXPIRED',
        ]);

        $response = $this->actingAs($this->user)
            ->get(route('paymant.rety.pembayaran', $paymantUserLain->id));

        $response->assertRedirect();
        $response->assertSessionHas('error');
    }

    /** @test */
    public function retry_payment_status_pending_tidak_bisa_di_retry()
    {
        $paymant = Mahasiswa_paymant::create([
            'user_id'           => $this->user->id,
            'biaya_id'          => $this->biaya->id,
            'merchant_order_id' => 'ORDER-PENDING-001',
            'payment_method'    => 'BR',
            'amount'            => 1000000,
            'status'            => 'pending',
        ]);

        $response = $this->actingAs($this->user)
            ->get(route('paymant.rety.pembayaran', $paymant->id));

        $response->assertRedirect();
        $response->assertSessionHas('error');
    }

    // =====================================================================
    // checkTransactionStatus Tests
    // =====================================================================

    /** @test */
    public function check_transaction_status_success_update_db_dan_generate_nim()
    {
        $departement = Departement::first() ?? Departement::create([
            'faculty_id'  => 1,
            'name'        => 'D3 Keperawatan',
            'description' => 'Test',
            'status'      => 'active',
        ]);

        $registrationPath = RegistrationPath::first() ?? RegistrationPath::create([
            'name'        => 'Gelombang 2',
            'title'       => 'Test',
            'description' => 'Test',
            'image'       => 'test.jpg',
            'start_date'  => now(),
            'end_date'    => now()->addMonth(),
            'amount'      => 300000,
            'status'      => 'open',
        ]);

        ProgramOption::create([
            'user_id'              => $this->user->id,
            'registration_path_id' => $registrationPath->id,
            'departement_id'       => $departement->id,
            'program_option'       => 1,
            'status'               => 'Daftar Ulang',
        ]);

        $paymant = Mahasiswa_paymant::create([
            'user_id'           => $this->user->id,
            'biaya_id'          => $this->biaya->id,
            'merchant_order_id' => 'ORDER-STATUS-CHECK',
            'payment_method'    => 'BR',
            'amount'            => 1000000,
            'status'            => 'pending',
        ]);

        Http::fake([
            '*duitku*' => Http::response([
                'merchantOrderId' => 'ORDER-STATUS-CHECK',
                'statusCode'      => '00',
                'statusMessage'   => 'SUCCESS',
                'amount'          => '1000000',
            ], 200),
        ]);

        $response = $this->actingAs($this->user)
            ->get(route('paymant.status', 'ORDER-STATUS-CHECK'));

        $this->assertDatabaseHas('mahasiswa_paymants', [
            'id'     => $paymant->id,
            'status' => 'SUCCESS',
        ]);

        $this->assertDatabaseHas('program_options', [
            'user_id' => $this->user->id,
            'status'  => 'Generate NIM',
        ]);
    }

    /** @test */
    public function check_transaction_status_expired_update_db()
    {
        $paymant = Mahasiswa_paymant::create([
            'user_id'           => $this->user->id,
            'biaya_id'          => $this->biaya->id,
            'merchant_order_id' => 'ORDER-WILL-EXPIRE',
            'payment_method'    => 'BR',
            'amount'            => 1000000,
            'status'            => 'pending',
        ]);

        Http::fake([
            '*duitku*' => Http::response([
                'merchantOrderId' => 'ORDER-WILL-EXPIRE',
                'statusCode'      => '01',
                'statusMessage'   => 'PROCESS',
                'amount'          => '1000000',
            ], 200),
        ]);

        $this->actingAs($this->user)
            ->get(route('paymant.status', 'ORDER-WILL-EXPIRE'));

        $this->assertDatabaseHas('mahasiswa_paymants', [
            'id'     => $paymant->id,
            'status' => 'EXPIRED',
        ]);
    }
}