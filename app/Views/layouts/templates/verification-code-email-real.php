<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Web properties -->
    <title>TOKUKAS</title>


    <style type="text/css">
        h6,
        h5,
        h4,
        h3,
        h2,
        h1 {
            font-weight: 500;
        }

        @media (min-width: 1200px) {

            h1 {
                font-size: 2.5rem;
            }
        }

        @media (min-width: 1200px) {
            h2 {
                font-size: 2rem;
            }
        }

        @media (min-width: 1200px) {
            h3 {
                font-size: 1.75rem;
            }
        }

        @media (min-width: 1200px) {
            h4 {
                font-size: 1.5rem;
            }
        }

        h5 {
            font-size: 1.25rem;
        }

        h6 {
            font-size: 1rem;
        }

        hr {
            color: inherit;
            background-color: currentColor;
            border: 0;
            opacity: 0.25;
        }

        hr:not([size]) {
            height: 1px;
        }

        img {
            border: 0;
        }

        .container {
            max-width: 100%;
            padding: 1rem 2rem;
        }

        .icon-btn {
            text-decoration: none;
            color: #ffffff;
            display: inline-block;
        }

        .icon-btn .i {
            color: #ffffff;
            height: 1rem;
            width: 1rem;
            font-size: small;
            vertical-align: middle;
        }

        .icon-btn:hover {
            color: #ffffff;
        }

        .vr {
            width: 1px !important;
            height: 1.5rem;
            background-color: #ffffff;
        }

        .mail-header {
            background-color: #0066cb;
            color: #ffffff;
            text-align: center;
        }

        .brand-name .primary {
            font-size: 1.2rem;
            line-height: 1.2rem;
            font-weight: 600;
        }

        .brand-name .secondary {
            font-size: 0.75rem;
            line-height: 0.75rem;
            text-indent: 2px;
        }

        .mail-content {
            background-color: #ffffff;
            color: #000000;
        }

        .mail-footer {
            background-color: #0066cb;
            color: #ffffff;
        }

        .mail-footer .section {
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="mail-header">
        <div class="container">
            <table style="Margin: auto; text-align: start; border-collapse: separate; border-spacing: 0.25rem 0;">
                <tbody>
                    <tr>
                        <td>
                            <img class="brand-logo" src="https://mcusercontent.com/f0c6140a1dcf32deec8308007/images/9db313ed-d12b-1c21-68cd-92eecb656638.png" height="24px" alt="brand-logo">
                        </td>
                        <td>
                            <table class="brand-name">
                                <tbody>
                                    <tr>
                                        <th class="primary">TOKUKAS</th>
                                    </tr>
                                    <tr>
                                        <td class="secondary">
                                            <span class="secondary">Toko Buku Bekas</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mail-content">
        <div class="container">
            <span style="font-size: 1.5rem; font-weight: 700; color: #0066cb;">Kode Verifikasi Anda</span>
            <hr>
            <div class="message">
                <p>Hai, <b><?= $recipient; ?></b>.</p>
                <p>Berikut kode untuk memverifikasi email anda :</p>
                <h1 style="text-align: center;"><?= $verificationCode; ?></h1>
                <p>Kode ini hanya berlaku selama <strong>30 menit</strong>. Silahkan masukkan kode tersebut pada halaman verifikasi email.</p>
                <p style="text-align: center;"><b>!!! Jangan memberitahukan kode tersebut kepada siapapun termasuk ke pihak TOKUKAS. !!!</b></p>
            </div>
        </div>
    </div>

    <div class="mail-footer">
        <div class="container">
            <div class="section">
                <p>Kunjungi Toko Kami di :</p>
                <table style="margin: 1rem auto; text-align: center; border-collapse: separate; border-spacing: 1rem 0;">
                    <tbody>
                        <tr>
                            <td>
                                <a href="https://tokopedia.com/tokukas" class="icon-btn">
                                    <img src="https://mcusercontent.com/f0c6140a1dcf32deec8308007/images/afdf9977-71a7-f9f4-47bc-4d5a690b561f.png" alt="tokopedia-logo" height="32px">
                                </a>
                            </td>
                            <td>
                                <a href="https://shopee.co.id/tokukas" class="icon-btn">
                                    <img src="https://mcusercontent.com/f0c6140a1dcf32deec8308007/images/ff6a1ca6-d832-b46d-eebc-b2dca7464a00.png" alt="shopee-logo" height="32px">
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="section">
                <a href="https://www.google.com/maps/search/" class="icon-btn">
                    <img src="https://mcusercontent.com/f0c6140a1dcf32deec8308007/images/724b938a-632d-34b7-4aee-1362ee3d6160.png" alt="icon" class="i" role="img">
                    <span>Jalan Pabean Kencana Raya No. 32, Desa Pabean Udik,
                        Kec. Indramayu, Kab. Indramayu, Jawa Barat 45219, Indonesia.</span>
                </a>
            </div>
            <div class="section">
                <table style="margin: 1rem auto; text-align: center; border-collapse: separate; border-spacing: 1rem 0;">
                    <tbody>
                        <tr>
                            <td>
                                <a href="mailto:" class="icon-btn">
                                    <img src="https://mcusercontent.com/f0c6140a1dcf32deec8308007/images/44fc8863-b1aa-cd11-b0d1-cf6cf4adafc9.png" alt="icon" class="i" role="img" height="16px">
                                    <span>tokukas@outlook.com</span>
                                </a>
                            </td>
                            <td>
                                <div class="vr"></div>
                            </td>
                            <td>
                                <a href="https://t.me/" class="icon-btn">
                                    <img src="https://mcusercontent.com/f0c6140a1dcf32deec8308007/images/8644c68e-3821-6734-6d90-08655aa26270.png" alt="icon" class="i" role="img" height="16px">
                                    <span>tokukas</span>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="section">
                <p><b>&copy; 2021 TOKUKAS</b></p>
            </div>
        </div>
    </div>

</body>

</html>
