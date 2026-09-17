@extends('admin.template.template', ['title' => 'Bantuan'])

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <div class="bg-white rounded-xl p-5 flex flex-col items-center justify-center gap-5 hover:shadow-lg">
        <img src="{{ asset('assets/icons/programer.svg') }}" alt="teknis" class="w-44">
        <div class="flex flex-col gap-3 items-start">
            <h1 class="font-sora text-lg mx-auto">Bantuan Teknis</h1>
            <span class="text-center">Pantau dan tangani laporan kendala teknis dari calon pendaftar, seperti error sistem, halaman tidak tampil, atau masalah login. Pastikan respons cepat agar proses pendaftaran berjalan lancar.</span>
            <a href="https://wa.me/6288970621727?text=Halo%20tim%20teknis%2C%20ada%20permintaan%20bantuan%20yang%20perlu%20ditangani%20terkait%20kendala%20pada%20sistem.%20Mohon%20diperiksa.%20Terima%20kasih." class="py-2 px-3 rounded-full bg-primary text-white mx-auto">Chat Programer</a>
        </div>
    </div>
    <div class="bg-white rounded-xl p-5 flex flex-col items-center justify-center gap-5 hover:shadow-lg">
        <img src="{{ asset('assets/icons/umum.svg') }}" alt="teknis" class="w-44">
        <div class="flex flex-col gap-3 items-start">
            <h1 class="font-sora text-lg mx-auto">Bantuan Umum</h1>
            <span class="text-center">Kelola pertanyaan umum seputar jadwal, alur pendaftaran, atau informasi program studi. Berikan informasi yang jelas dan tepat kepada calon mahasiswa.</span>
            <a href="https://wa.me/6285691422220?text=Halo%20tim%20bantuan%20umum%2C%20terdapat%20pertanyaan%20yang%20perlu%20ditanggapi%20terkait%20informasi%20pendaftaran.%20Mohon%20diperiksa.%20Terima%20kasih." class="py-2 px-3 rounded-full bg-primary text-white mx-auto">Chat Programer</a>
        </div>
    </div>
</div>
@endsection