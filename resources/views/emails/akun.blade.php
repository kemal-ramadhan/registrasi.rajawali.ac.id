<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penerimaan Mahasiswa Baru - Institut Kesehatan Rajawali</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Inter;
        }

        body {
            background-color: #f3f4f4;
            min-height: 100vh;
            padding: 68px;
        }

        .body-table {
            width: 100%;
            max-width: 700px;
            margin: 0 auto;
        }

        .header {
            padding: 20px 0px 20px 0px;
            width: 100%;
        }

        .header-table {
            width: 100%;
        }

        .logo {
            width: 50px;
            height: 50px;
            margin-right: 15px;
        }

        .header-text {
            vertical-align: middle;
        }

        .header-title {
            font-size: 14px;
            font-weight: 500;
            color: #555;
        }

        .header-university {
            font-size: 18px;
            font-weight: 600;
            color: #333;
        }

        .content {
            width: 100%;
            max-width: 700px;
            background-color: #FFFFFF;
            border-radius: 30px;
            padding: 52px 45px 52px 45px;
            margin: 15px 0;
            text-align: center;
        }

        .content-table {
            width: 100%;
            background-color: #FFFFFF;
        }

        .main-heading {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 30px;
        }

        .greeting {
            font-size: 10px;
            color: #9CA0A8;
            margin-bottom: 10px;
        }

        .thank-you {
            font-size: 10px;
            color: #9CA0A8;
            margin-bottom: 10px;
        }

        .account-confirmation {
            font-size: 10px;
            color: #9CA0A8;
            margin-bottom: 30px;
        }

        .poster_box {
            width: 100%;
            height: 350px;
            border-radius: 10px;
            margin-bottom: 30px;
            overflow: hidden;
            position: relative;
        }

        .poster_box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 30px;
        }

        .online-info {
            font-size: 10px;
            color: #9CA0A8;
            margin-bottom: 10px;
        }

        .login-box {
            width: 100%;
        }

        .login-details {
            font-size: 10px;
            color: #9CA0A8;
            margin-bottom: 20px;
        }

        .login-credential {
            font-weight: 500;
            margin: 10px 0;
            text-align: center;
        }

        .login-credential img {
            width: 20px;
            vertical-align: middle;
        }

        .login-credential-pw {
            font-weight: 500;
            margin: 10px 0 30px;
            text-align: center;
        }

        .login-credential-pw img {
            width: 15px;
            vertical-align: middle;
        }

        .credential-icon {
            color: #3342FF;
            margin-right: 10px;
        }

        .instruction {
            font-size: 10px;
            color: #9CA0A8;
            margin-bottom: 20px;
        }

        .login-link {
            color: #3342FF;
            text-decoration: none;
            font-weight: 600;
            font-style: italic;
            margin-bottom: 20px;
            display: block;
        }

        .or-text {
            font-size: 10px;
            color: #9CA0A8;
            margin-bottom: 20px;
        }

        .continue-button {
            background-color: #3342FF;
            color: #FFFFFF;
            border: none;
            border-radius: 50px;
            padding: 15px 25px;
            font-size: 10px;
            cursor: pointer;
            font-weight: 500;
            width: 250px;
        }

        .social-icons {
            width: 100%;
            max-width: 700px;
            margin: 20px 0;
        }

        .social-icons-table {
            width: 100%;
            text-align: center;
            margin: 20px 0 20px 0;
        }

        .social-icon {
            width: 50px;
            height: 50px;
            background-color: #FFFFFF;
            border-radius: 50%;
            display: inline-block;
            margin: 0 15px;
        }

        .social-icon img {
            width: 25px;
            vertical-align: middle;
            margin-top: 12px;
        }

        .border {
            width: 100%;
            max-width: 700px;
            border-bottom: 1px solid #C0C4CC;
            margin: 20px 0px 20px 0px;
        }

        .contact-info {
            font-size: 10px;
            color: #9CA0A8;
            margin: 15px 0 30px;
            text-align: center;
        }

        .address {
            font-size: 14px;
            color: #9CA0A8;
            margin-bottom: 30px;
            text-align: center;
        }

        .footer {
            width: 100%;
            max-width: 700px;
            margin-bottom: 30px;
            text-align: center;
        }

        .footer-table {
            width: 100%;
            text-align: center;
        }

        .footer-link {
            color: #9CA0A8;
            font-size: 10px;
            margin: 0 10px;
        }

        .divider {
            color: #9CA0A8;
        }

        @media screen and (max-width: 768px) {
            .responsive-br {
                display: inline;
            }

            body {
                padding: 20px;
            }

            .header {
                padding: 20px;
                margin-bottom: 20px;
            }

            .content {
                padding: 20px;
                margin: 0;
                box-shadow: none;
            }

            .main-heading {
                font-size: 20px;
                line-height: 1.4;
            }

            .poster_box {
                height: 300px;
                margin-bottom: 25px;
            }

            .poster_box img{
                border-radius: 10px;
            }

            .login-box {
                width: 100%;
            }

            .login-credential,
            .login-credential-pw {
                text-align: left;
                width: 100%;
            }

            .login-link {
                font-size: 14px;
                word-break: break-all;
            }

            .continue-button {
                width: 100%;
            }

            .social-icons {
                margin: 30px 0;
            }

            .social-icon {
                width: 40px;
                height: 40px;
                margin: 0 10px;
            }

            .social-icon img {
                width: 20px;
                margin-top: 10px;
            }

            .contact-info br,
            .address br {
                display: none;
            }

            .contact-info,
            .address {
                padding: 0 20px;
            }

            .footer {
                margin: 20px 0 30px;
            }

            .footer-link {
                font-size: 14px;
            }
        }

        @media screen and (max-width: 480px) {
            .responsive-br {
                display: none;
            }

            .header {
                padding: 15px;
            }

            .logo {
                width: 40px;
                height: 40px;
                margin-right: 15px;
            }

            .header-text {
                display: table-cell;
                vertical-align: middle;
            }

            .header-title {
                font-size: 12px;
                font-weight: 500;
                color: #555;
            }

            .header-university {
                font-size: 10px;
                font-weight: 600;
                color: #333;
            }

            .content {
                padding: 30px 20px;
                margin: 0;
                text-align: center;
                border-radius: 20px;
            }

            .main-heading {
                font-size: 18px;
                margin-bottom: 20px;
            }

            .greeting,
            .thank-you,
            .account-confirmation,
            .online-info,
            .login-details,
            .instruction {
                font-size: 14px;
            }

            .poster_box {
                height: 200px;
                margin-bottom: 20px;
            }

            .poster_box img{
                border-radius: 10px;
            }

            .login-box {
                width: 100%;
                margin-bottom: 10px;
                border-radius: 20px;
            }

            .login-credential,
            .login-credential-pw {
                text-align: center;
                width: auto;
            }

            .login-credential-pw {
                margin-bottom: 20px;
            }

            .login-link {
                font-size: 13px;
                margin-bottom: 15px;
            }

            .or-text {
                margin-bottom: 15px;
            }

            .continue-button {
                width: 80%;
                padding: 12px 20px;
            }

            .social-icons {
                margin-top: 25px;
                margin-bottom: 15px;
            }

            .social-icon {
                width: 35px;
                height: 35px;
                margin: 0 8px;
            }

            .social-icon img {
                width: 20px;
                margin-top: 8px;
            }

            .contact-info {
                font-size: 14px;
                margin: 15px 0 20px;
            }

            .address {
                font-size: 14px;
                line-height: 1.5;
                margin-bottom: 20px;
            }

            .footer-link {
                font-size: 14px;
            }
        }
    </style>
</head>

<body style="background-color: #f3f4f4; padding-bottom: 30px;">
    <table class="body-table">
        <tr>
            <td>
                <table class="header-table">
                    <tr>
                        <td class="header">
                            <table>
                                <tr>
                                    <td><img src="{{ asset('assets/icons/IKes.png') }}" alt="Logo Institut Kesehatan Rajawali" class="logo"></td>
                                    <td class="header-text">
                                        <div class="header-title">Penerimaan Mahasiswa Baru</div>
                                        <div class="header-university">Institut Kesehatan Rajawali</div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <table class="content-table" style="background-color: #FFFFFF; border-radius: 30px;">
                    <tr>
                        <td class="content">
                            <h1 class="main-heading">Selamat Bergabung di PMB Institut Kesehatan Rajawali! <br class="responsive-br"> Saatnya Lanjutkan
                                Pendaftaranmu</h1>

                            <p class="greeting">Halo {{ $name }},</p>
                            <p class="thank-you">Terima kasih telah mendaftar di Institut Kesehatan Rajawali.</p>
                            <p class="account-confirmation">Akun kamu telah berhasil dibuat di sistem pendaftaran online kami.</p>

                            <div class="poster_box">
                                <img src="https://registrasi.unpas.ac.id/assets/emails/poster.jpg" alt="Poster PMB UNPAS">
                            </div>

                            <p class="online-info">Kamu sudah bisa melanjutkan proses pendaftaran secara online.</p>
                            <p class="login-details">Berikut detail Login kamu:</p>

                            <table class="login-box">
                                <tr>
                                    <td>
                                        <div class="login-credential">
                                            <img src="https://registrasi.unpas.ac.id/assets/emails/username.png" alt="">
                                            <span>Username: {{ $username }}</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="login-credential-pw">
                                            <img src="https://registrasi.unpas.ac.id/assets/emails/password.png" alt="">
                                            <span>Password: {{ $password }}</span>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <p class="instruction">Klik link dibawah ini untuk melanjutkan proses pendaftaran.</p>
                            <a href="https://situ2.unpas.ac.id/spmbfront/login"
                                class="login-link">https://situ2.unpas.ac.id/spmbfront/login</a>

                            <p class="or-text">atau</p>

                            <a href="https://situ2.unpas.ac.id/spmbfront/login" class="continue-button" style="color: #FFFFFF;">Lanjutkan Pendaftaran</a>
                        </td>
                    </tr>
                </table>

                <table class="social-icons-table">
                    <tr>
                        <td class="social-icons">
                            <a href="https://www.instagram.com/pmbunpas/" target="_blank" class="social-icon">
                                <img src="https://registrasi.unpas.ac.id/assets/emails/ig.png" alt="Instagram">
                            </a>
                            <a href="https://www.tiktok.com/@univ_pasundan" target="_blank" class="social-icon">
                                <img src="https://registrasi.unpas.ac.id/assets/emails/tiktok.png" alt="TikTok">
                            </a>
                            <a href="https://www.youtube.com/@UniversitasPasundanOfficial" target="_blank" class="social-icon">
                                <img src="https://registrasi.unpas.ac.id/assets/emails/yt.png" alt="YouTube">
                            </a>
                        </td>
                    </tr>
                </table>

                <div class="border"></div>

                <p class="contact-info">Jika kamu memiliki pertanyaan, silakan hubungi kami di <br> infopmb@unpas.ac.id</p>

                <p class="address">Jl. Tamansari No.6-8, Tamansari, Kec. Bandung Wetan, Kota Bandung, <br> Jawa Barat</p>

                <table class="footer-table">
                    <tr>
                        <td class="footer">
                            <a href="#" class="footer-link">Terms of use</a>
                            <span class="divider">|</span>
                            <a href="#" class="footer-link">Privacy Policy</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>