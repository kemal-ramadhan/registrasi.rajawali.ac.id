<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <style>
        @page {
            size: 85.6mm 54mm;
            margin: 0;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 5px;
            margin: 0;
            padding: 0;
        }

        .kartu-ujian {
            border: 1px solid #000;
            width: 85.6mm;
            height: 54mm;
            box-sizing: border-box;
            overflow: hidden;
            padding: 1.5mm;
            position: relative;
        }

        /* ================= HEADER ================= */
        .header-universitas {
            text-align: center;
            border-bottom: 1px solid #000;
            margin-bottom: 1mm;
            padding-bottom: 0.5mm;
        }

        .logo-header {
            height: 7mm;
            margin-bottom: 0.5mm;
        }

        .header-universitas h1 {
            margin: 0;
            font-size: 7px;
            font-weight: bold;
        }

        .header-universitas p {
            margin: 0;
            font-size: 5px;
        }

        /* ================= DATA ================= */
        .konten-utama {
            display: table;
            width: 100%;
        }

        .foto-peserta {
            display: table-cell;
            width: 16mm;
            height: 18mm;
            border: 1px solid #000;
            overflow: hidden;
        }

        .foto-peserta img {
            width: 100%;
            object-fit: cover;
            object-position: center;
        }

        .info-peserta {
            display: table-cell;
            vertical-align: top;
            padding-left: 1.5mm;
        }

        .info-row {
            display: table;
            width: 100%;
            margin-bottom: 0.5mm;
        }

        .info-label {
            display: table-cell;
            width: 15mm;
            font-weight: bold;
        }

        .info-value {
            display: table-cell;
        }

        /* ================= JADWAL ================= */
        .jadwal-ujian {
            position: relative;
            border: 1px solid #000;
            padding: 1mm;
            margin-top: 1mm;
            height: 16mm;
        }

        .jadwal-ujian::before {
            content: "";
            background: url("{{ public_path('assets/icons/IKes.png') }}") center no-repeat;
            background-size: 40mm;
            opacity: 0.08;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 45mm;
            height: 45mm;
            z-index: 0;
        }

        .jadwal-title,
        .jadwal-item {
            position: relative;
            z-index: 1;
        }

        .jadwal-title {
            font-weight: bold;
            font-size: 6px;
            text-align: center;
            margin-bottom: 0.5mm;
            text-decoration: underline;
        }

        .jadwal-item {
            display: table;
            width: 100%;
            border-bottom: 1px solid #aaa;
            font-size: 5px;
        }

        .jadwal-item span {
            display: table-cell;
            width: 33%;
            padding: 0.2mm 0;
        }

        /* ================= CATATAN ================= */
        .catatan {
            margin-top: 1mm;
            font-size: 5px;
            line-height: 1.1;
        }

        /* ================= FOOTER ================= */
        .footer {
            display: table;
            width: 100%;
            margin-top: 1mm;
            text-align: center;
        }

        .ttd-panitia {
            display: table-cell;
            width: 50%;
            font-size: 5px;
        }

        .space {
            height: 4mm;
        }

        .garis {
            border-top: 1px solid #000;
        }
    </style>
</head>

<body>

    <div class="kartu-ujian">

        <!-- HEADER -->
        <div class="header-universitas">
            <img src="{{ public_path('assets/icons/IKes.png') }}" class="logo-header" alt="Logo">
            <h1>KARTU PESERTA</h1>
            <p>INSTITUT KESEHATAN RAJAWALI</p>
            <p>Jl. Letjen Mashudi No.20, Tasikmalaya</p>
        </div>

        <!-- DATA -->
        <div class="konten-utama">
            <div class="foto-peserta">
                <img src="{{ public_path('storage/' . ($akun->profile ?? 'default.png')) }}" alt="Foto Peserta">
            </div>

            <div class="info-peserta">
                <div class="info-row">
                    <div class="info-label">Nama</div>
                    <div class="info-value">: {{ $akun->name }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">No. Peserta</div>
                    <div class="info-value">: {{ auth()->user()->created_at->format('Ymd') }}{{ auth()->user()->id }}-{{ $programOption->id }}
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-label">JK</div>
                    <div class="info-value">: {{ $personal->gander }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Lahir</div>
                    <div class="info-value">: {{ $personal->date_of_birth }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Prodi</div>
                    <div class="info-value">: {{ $programOption->departement_name ?? '-' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Jadwal Ujian</div>
                    <div class="info-value">:</div>
                </div>
            </div>
        </div>

        <!-- CATATAN -->
        <div class="catatan">
            Hadir 15 menit sebelum ujian. Peserta wajib membawa identitas asli & kartu ini.
        </div>

        <!-- FOOTER -->
        <div class="footer">
            <div class="ttd-panitia">
                <div class="space"></div>
                <div class="garis">{{ auth()->user()->name }}</div>
            </div>
            <div class="ttd-panitia">
                <div class="space"></div>
                <div class="garis">Admisi IKes Rajawali</div>
            </div>
        </div>

    </div>

</body>

</html>