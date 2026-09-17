<?php

use App\Http\Controllers\BantuanControllers;
use App\Http\Controllers\BiayaController;
use App\Http\Controllers\BkController;
use App\Http\Controllers\CheckSeleksiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartementReferensiController;
use App\Http\Controllers\EmailOtpNotificationController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\FakultasReferensiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LisanController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MetodePaymantController;
use App\Http\Controllers\PaymantsController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PembayaranMahasiswaController;
use App\Http\Controllers\PersonalDataController;
use App\Http\Controllers\ProcessRegistrationController;
use App\Http\Controllers\ProfileAdminController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ReferalBkController;
use App\Http\Controllers\ReferalController;
use App\Http\Controllers\ReferensiController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\RegistrationPathReferensiController;
use App\Http\Controllers\RegistrationProgram;
use App\Http\Controllers\RegistrationTestController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SeleksiMabaController;
use App\Models\User;
use Google\Service\AdSenseHost\Report;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Verifikasi Email
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function ($id, $hash) {
    $user = User::findOrFail($id);

    if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
        abort(403, 'Hash tidak cocok.');
    }

    if ($user->hasVerifiedEmail()) {
        return redirect('/login')->with('status', 'Email sudah diverifikasi.');
    }

    $user->markEmailAsVerified();
    event(new Verified($user));

    return redirect('/login')->with('status', 'Email berhasil diverifikasi!');
})->middleware(['signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Email verifikasi telah dikirim ulang!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/registration', function () {
    return view('auth.register');
})->name('auth.register');

Route::post('/verify-otp', [EmailOtpNotificationController::class, 'verify'])->name('otp.verify.post');
Route::post('/resend-otp', [EmailOtpNotificationController::class, 'resend'])->name('otp.resend');

Route::post('/callback', [RegistrationProgram::class, 'callback'])->name('paymant.callback');
Route::post('/paymant-her/callback', [PembayaranController::class, 'callback'])->name('paymant.her.callback');

Route::middleware(['auth', 'verified', 'Customer'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('beranda');
    Route::get('/jalur-pendaftaran', [HomeController::class, 'indexJalurPendaftaran'])->name('jalur.pendaftaran');

    Route::post('/foto-profile', [PersonalDataController::class, 'storeFotoProfile'])->name('profile.data.store');

    Route::get('/personal-data', [PersonalDataController::class, 'index'])->name('personal.data.index');
    Route::post('/create-data', [PersonalDataController::class, 'store'])->name('personal.data.store');

    Route::get('/personal-education', [PersonalDataController::class, 'indexPendidikan'])->name('personal.data.pendidikan');
    Route::post('/create-education', [PersonalDataController::class, 'storeEducation'])->name('personal.data.store.education');

    Route::get('/personal-address', [PersonalDataController::class, 'indexAddress'])->name('personal.data.address');
    Route::post('/create-address', [PersonalDataController::class, 'storeAddress'])->name('personal.data.store.address');

    Route::get('/personal-income', [PersonalDataController::class, 'indexIncome'])->name('personal.data.income');
    Route::post('/create-income', [PersonalDataController::class, 'storeIncome'])->name('personal.data.store.income');

    Route::get('/personal-family', [PersonalDataController::class, 'indexFamily'])->name('personal.data.family');
    Route::post('/create-family', [PersonalDataController::class, 'storeFamily'])->name('personal.data.store.family');

    // registration
    Route::get('/registration-program', [RegistrationController::class, 'index'])->name('registration.program');
    Route::get('/registration-fakultas/{id}', [RegistrationController::class, 'indexFakultas'])->name('registration.fakultas');
    Route::get('/registration-departement/{id}', [RegistrationController::class, 'indexDepartement'])->name('registration.departement');
    Route::get('/registration-path/{id}', [RegistrationController::class, 'indexPath'])->name('registration.path');
    Route::get('/registration-path-detail/{id}/{idDepartement}', [RegistrationController::class, 'indexPathDetail'])->name('registration.path.detail');

    // Registrastion Cutomer
    Route::get('/choice-registration/{id}/{idDepartement}', [RegistrationProgram::class, 'store'])->name('registration.program.choice');

    Route::get('/option-registration/{id}', [RegistrationProgram::class, 'index'])->name('registration.option');
    Route::get('/option-registration-delete/{id}', [RegistrationProgram::class, 'destroyOption'])->name('registration.option.delete');
    Route::get('/option-registration-document/{id}', [RegistrationProgram::class, 'indexDocument'])->name('registration.option.document');
    Route::post('/create-registration-document', [RegistrationProgram::class, 'storeDokumen'])->name('registration.option.document.store');
    Route::get('/registration/option/document/delete/{field}', [RegistrationProgram::class, 'deleteDokumen'])->name('registration.option.document.delete');
    Route::get('/registration/option/document/delete-syarat/{id}', [RegistrationProgram::class, 'deleteDokumenSyarat'])->name('registration.option.document.syarat.delete');
    Route::get('/option-registration-paymant/{id}', [RegistrationProgram::class, 'indexPayment'])->name('registration.option.paymant');
    Route::get('/option-registration-test/{id}', [RegistrationProgram::class, 'indexFinal'])->name('registration.option.test');

    Route::get('/kartu-peserta/{id}', [ReportController::class, 'kartuPeserta'])->name('kartu.peserta');

    // paymant
    Route::get('/paymant/{id}', [RegistrationProgram::class, 'paymant'])->name('paymant');
    Route::get('/paymant-bk/{id}', [RegistrationProgram::class, 'paymantBk'])->name('paymant.bk');
    Route::post('/paymant-pay', [RegistrationProgram::class, 'storePaymant'])->name('registration.option.pay');
    Route::post('/paymant-pay-bk', [RegistrationProgram::class, 'storePaymantBk'])->name('registration.option.pay.bk');
    Route::get('/transaction/{merchantOrderId}', [RegistrationProgram::class, 'checkTransactionStatus'])->name('transaction.status');
    Route::get('/retry-payment/{merchantOrderId}', [RegistrationProgram::class, 'retryPayment'])->name('retry.payment');

    // unduh kartu
    Route::get('/kartu/{id}', [RegistrationProgram::class, 'akun'])->name('akun');

    // Seleksi
    Route::resources([
        'test' => SeleksiMabaController::class,
    ]);
    Route::get('/test/mytest/{id}', [SeleksiMabaController::class, 'indexDetailTest'])->name('seleksi.calon');
    Route::post('/test/gabung', [SeleksiMabaController::class, 'storeGabung'])->name('test.gabung');
    Route::get('/test/hasil/{id}', [SeleksiMabaController::class, 'showHasil'])->name('test.nilai');

    Route::post('/test/start', [SeleksiMabaController::class, 'store'])->name('test.start');
    Route::get('/exam/{id}/question/{questionNumber?}', [SeleksiMabaController::class, 'question'])->name('test.question');
    Route::post('/exam/{id}/question/{questionNumber}', [SeleksiMabaController::class, 'storeAnswer'])->name('test.answer.store');
    Route::post('/test/finish', [SeleksiMabaController::class, 'storeFinish'])->name('test.finish');
    Route::get('/exam/result/{id}', [SeleksiMabaController::class, 'indexResult'])->name('test.result');

    // paymant
    Route::resources([
        'paymant' => PembayaranController::class,
    ]);
    Route::get('/paymant/pembayaran/{id}', [PembayaranController::class, 'paymant'])->name('retry.paymant');
    Route::get('/paymant/show/{id}', [PembayaranController::class, 'show'])->name('paymant.show');
    Route::post('/paymant-pay/store', [PembayaranController::class, 'storePaymant'])->name('paymant.pay');
    Route::get('/paymant-pay/status/{merchantOrderId}', [PembayaranController::class, 'checkTransactionStatus'])->name('paymant.status');
    Route::get('/paymant-pay/retry/{id}', [PembayaranController::class, 'checkTransactionStatus'])->name('paymant.rety.pembayaran');
    Route::get('/bantuan-customer', [SeleksiMabaController::class, 'bantuan'])->name('bantuan.customer');
    Route::get('/invoice/{id}', [PembayaranController::class, 'invoice'])->name('invoice');
});

// admin
Route::middleware(['auth', 'Admin'])->group(function () {
Route::delete('/process/soft-delete/{id}', [ProcessRegistrationController::class, 'softDelete'])->name('process.soft-delete');
Route::post('/process/restore/{id}', [ProcessRegistrationController::class, 'restore'])->name('process.restore');
Route::delete('/process/force-delete/{id}', [ProcessRegistrationController::class, 'forceDelete'])->name('process.force-delete');
Route::post('/process/clean-old', [ProcessRegistrationController::class, 'cleanOldDeleted'])->name('process.clean-old');
    Route::get('/activity-log', [\App\Http\Controllers\ActivityLogController::class, 'index'])->name('activitylog.index');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // referensi
    Route::get('/jenjang-program', [ReferensiController::class, 'index'])->name('referensi.jenjang');
    Route::get('/jenjang-program/create', [ReferensiController::class, 'create'])->name('referensi.jenjang.create');
    Route::post('/jenjang-program/store', [ReferensiController::class, 'store'])->name('referensi.jenjang.store');
    Route::get('/jenjang-program/edit/{id}', [ReferensiController::class, 'edit'])->name('referensi.jenjang.edit');
    Route::get('/jenjang-program/destroy/{id}', [ReferensiController::class, 'destroy'])->name('referensi.jenjang.delete');
    Route::put('/jenjang-program/update/{id}', [ReferensiController::class, 'update'])->name('referensi.jenjang.update');

    // Referal
    Route::resources([
        'referal' => ReferalController::class,
    ]);

    // Fakultas
    Route::resources([
        'fakultas' => FakultasReferensiController::class,
    ]);

    // Departement
    Route::resources([
        'departement' => DepartementReferensiController::class,
    ]);

    // Registration Path
    Route::resources([
        'registration' => RegistrationPathReferensiController::class,
    ]);
    // add dokumen
    Route::get('registration/setting-dokumen/{id}', [RegistrationPathReferensiController::class, 'indexDocs'])->name('registration.indexDocs');
    Route::post('registration/create-dokumen', [RegistrationPathReferensiController::class, 'storeDocs'])->name('registration.storeDocs');
    Route::get('/registration/dokumen/destroy/{id}', [RegistrationPathReferensiController::class, 'destroyDocs'])->name('registration.dokumen.delete');

    // add departement
    Route::get('registration/setting-departement/{id}', [RegistrationPathReferensiController::class, 'indexDepartement'])->name('registration.indexDepartement');
    Route::post('registration/create-departement', [RegistrationPathReferensiController::class, 'storeDepartement'])->name('registration.storeDepartement');
    Route::get('/registration/departement/destroy/{id}', [RegistrationPathReferensiController::class, 'destroyDepartement'])->name('registration.departement.delete');

    // Mahasiswa
    Route::resources([
        'mahasiswa' => MahasiswaController::class,
    ]);
    Route::put('/mahasiswa/referal/{id}', [MahasiswaController::class, 'updateReferal'])->name('mahasiswa.updateReferal');

    // Pembayara
    Route::resources([
        'pembayaran' => PaymantsController::class,
    ]);

    // Pembayara
    Route::resources([
        'registration-test' => RegistrationTestController::class,
    ]);

    // Registration Path
    Route::resources([
        'process' => ProcessRegistrationController::class,
    ]);
    Route::post('/process/paymant/{id}', [ProcessRegistrationController::class, 'updatePaymentStatus'])->name('process.update.paymant');
    Route::post('/process/paymant/bk/{id}', [ProcessRegistrationController::class, 'updatePaymentStatusBk'])->name('process.update.paymant.bk');
    Route::post('/process/paymant/mahasiswa/{id}', [ProcessRegistrationController::class, 'updatePaymentMahasiswaStatus'])->name('process.update.paymantMahasiswa');
    Route::post('/process/status/{id}', [ProcessRegistrationController::class, 'updateRegistrationStatus'])->name('process.update.status');
    Route::post('/process/genaret-nim/{id}', [ProcessRegistrationController::class, 'generateNim'])->name('process.generate.nim');

    // Metode Pembayaran
    Route::resources([
        'metode' => MetodePaymantController::class,
    ]);
    Route::post('metode/create-kategori', [MetodePaymantController::class, 'storeKategori'])->name('metode.storeKategori');

    // Profile
    Route::resources([
        'admin' => ProfileAdminController::class,
    ]);

    // Endpoint Update Email & Destroy User di Report
    Route::put('/report/update-email/{id}', [ReportController::class, 'updateEmail'])->name('report.updateEmail');
    Route::delete('/report/destroy-user/{id}', [ReportController::class, 'destroyUser'])->name('report.destroyUser');

    // report
    Route::resources([
        'reports' => ReportController::class,
    ]);
    Route::get('report/pendaftar', [ReportController::class, 'export'])->name('report.export');

    Route::resources([
        'bantuan' => BantuanControllers::class,
    ]);

    // exams
    Route::resources([
        'exam' => ExamController::class,
    ]);

    // lisan
    Route::resources([
        'lisan' => LisanController::class,
    ]);

    // exams
    Route::get('/question/create/{id}', [QuestionController::class, 'create'])->name('question.create');
    Route::get('/question/edit/{id}', [QuestionController::class, 'edit'])->name('question.edit');
    Route::put('/questions/{id}', [QuestionController::class, 'update'])->name('questions.update');
    Route::post('/question/store', [QuestionController::class, 'store'])->name('question.store');
    Route::get('/question/create-choice/{id}/{question_id}', [QuestionController::class, 'createChoice'])->name('question.choice');
    Route::post('/question/create-choice/store', [QuestionController::class, 'storeChoice'])->name('choices.store');
    Route::delete('/question/{id}', [QuestionController::class, 'destroy'])->name('question.destroy');
    Route::delete('/choices/{id}', [QuestionController::class, 'destroyChoices'])->name('choices.destroy');

    // cek seleksi
    Route::resources([
        'result' => CheckSeleksiController::class,
    ]);
    Route::get('/particimant/{id}', [CheckSeleksiController::class, 'index'])->name('particimant.index');
    Route::get('/result/{exam}/{user}', [CheckSeleksiController::class, 'show'])->name('result.show');
    Route::get('/result/nilai/{exam}/{user}', [CheckSeleksiController::class, 'nilai'])->name('result.nilai');
    Route::post('/result/hasil/store', [CheckSeleksiController::class, 'storeHasil'])->name('hasil.store');

    // cek seleksi
    Route::resources([
        'biayareferensi' => BiayaController::class,
    ]);
    Route::get('/scema/{id}', [BiayaController::class, 'createScema'])->name('biaya.scema');
    Route::get('/scema/detail/{id}', [BiayaController::class, 'showScema'])->name('biaya.scema.detail');
    Route::post('/scema/store', [BiayaController::class, 'storeScema'])->name('biaya.scema.store');
    Route::get('/scema/edit/{id}', [BiayaController::class, 'editScema'])->name('biaya.scema.edit');
    Route::put('/scema/update/{id}', [BiayaController::class, 'updateScema'])->name('biaya.scema.update');
    Route::post('/scema/detail/store', [BiayaController::class, 'storeDetailScema'])->name('scema.detail.store');
    Route::delete('/scema/detail/destroy/{id}', [BiayaController::class, 'destroyDetail'])->name('scema.detail.destroy');
    Route::get('/biaya/{id}/jalur', [BiayaController::class, 'indexJalur'])->name('biaya.jalur.index');
    Route::post('/biaya/{id}/jalur', [BiayaController::class, 'storeJalur'])->name('biaya.jalur.store');

    // Pembayaran Mahasiswa
    Route::resources([
        'mahasiswa-paymant' => PembayaranMahasiswaController::class,
    ]);
});

Route::middleware(['auth', 'BK'])->group(function () {
    Route::get('/bk', [BkController::class, 'index'])->name('dashboard.bk');

    Route::resources([
        'referalBk' => ReferalBkController::class,
    ]);
});
