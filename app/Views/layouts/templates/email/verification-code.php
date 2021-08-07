<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Web properties -->
    <title>TOKUKAS</title>
    <style>
        .icon-btn:hover {
            color: #ffffff
        }
    </style>
    <style type="text/css">
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
    </style>
</head>

<body>
    <div class="mail-header" style="background-color:#0066cb;color:#ffffff;text-align:center;">
        <div class="container" style="max-width:100%;padding:1rem 2rem;">
            <table style="Margin: auto; text-align: start; border-collapse: separate; border-spacing: 0.25rem 0;">
                <tbody>
                    <tr>
                        <td>
                            <img class="brand-logo" src="https://mcusercontent.com/f0c6140a1dcf32deec8308007/images/9db313ed-d12b-1c21-68cd-92eecb656638.png" height="24px" alt="brand-logo" style="border:0;">
                        </td>
                        <td>
                            <table class="brand-name">
                                <tbody>
                                    <tr>
                                        <th class="primary" style="font-size:1.2rem;line-height:1.2rem;font-weight:600;">TOKUKAS</th>
                                    </tr>
                                    <tr>
                                        <td class="secondary" style="font-size:0.75rem;line-height:0.75rem;text-indent:2px;">
                                            <span class="secondary" style="font-size:0.75rem;line-height:0.75rem;text-indent:2px;">Toko Buku Bekas</span>
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
    <div class="mail-content" style="background-color:#ffffff;color:#000000;">
        <div class="container" style="max-width:100%;padding:1rem 2rem;">
            <span style="font-size: 1.5rem; font-weight: 700; color: #0066cb;">Kode Verifikasi Anda</span>
            <hr style="color:inherit;background-color:currentColor;border:0;opacity:0.25;height:1px;">
            <div class="message">
                <p>Hai, <b><?= $recipient; ?></b>.</p>
                <p>Berikut kode untuk memverifikasi email anda :</p>
                <h1 style="font-weight:500;text-align: center;"><strong><?= $verificationCode; ?></strong></h1>
                <p>Kode ini hanya berlaku selama <strong><?= $minutesUntilCodeExpires; ?> menit</strong>. Silahkan masukkan
                    kode tersebut pada halaman
                    verifikasi email.</p>
                <hr style="color:inherit;background-color:currentColor;border:0;opacity:0.25;height:1px;">
                <p style="text-align: center;">
                    <strong>!!! JANGAN MEMBERITAHUKAN KODE INI KEPADA SIAPAPUN termasuk pihak TOKUKAS !!!</strong>
                </p>
            </div>
        </div>
    </div>
    <div class="mail-footer" style="background-color:#0066cb;color:#ffffff;">
        <div class="container" style="max-width:100%;padding:1rem 2rem;">
            <div class="section" style="text-align:center;">
                <p>Kunjungi Toko Kami di :</p>
                <table style="margin: 1rem auto; text-align: center; border-collapse: separate; border-spacing: 1rem 0;">
                    <tbody>
                        <tr>
                            <td>
                                <a href="https://tokopedia.com/tokukas" class="icon-btn" style="text-decoration:none;color:#ffffff;display:inline-block;">
                                    <img src="https://mcusercontent.com/f0c6140a1dcf32deec8308007/images/afdf9977-71a7-f9f4-47bc-4d5a690b561f.png" alt="tokopedia-logo" height="32px" style="border:0;">
                                </a>
                            </td>
                            <td>
                                <a href="https://shopee.co.id/tokukas" class="icon-btn" style="text-decoration:none;color:#ffffff;display:inline-block;">
                                    <img src="https://mcusercontent.com/f0c6140a1dcf32deec8308007/images/ff6a1ca6-d832-b46d-eebc-b2dca7464a00.png" alt="shopee-logo" height="32px" style="border:0;">
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p style="font-size: 0.75rem;">
                    <a href="https://www.google.com/maps/search/tokukas" class="icon-btn" style="text-decoration:none;color:#ffffff;display:inline-block;">
                        <img src="https://mcusercontent.com/f0c6140a1dcf32deec8308007/images/724b938a-632d-34b7-4aee-1362ee3d6160.png" alt="icon" class="i" role="img" style="border:0;color:#ffffff;height:1rem;width:1rem;font-size:small;vertical-align:middle;">
                        <span>Jalan Pabean Kencana Raya No. 32, Desa Pabean Udik,
                            Kec. Indramayu, Kab. Indramayu, Jawa Barat 45219, Indonesia.</span>
                    </a>
                </p>
            </div>
            <div class="section" style="text-align:center;">
                <table style="margin: 1rem auto; text-align: center; border-collapse: separate; border-spacing: 0.5rem 0;">
                    <tbody>
                        <tr>
                            <td>
                                <a href="mailto:tokukas@outlook.com" class="icon-btn" style="text-decoration:none;color:#ffffff;display:inline-block;">
                                    <img src="https://mcusercontent.com/f0c6140a1dcf32deec8308007/images/44fc8863-b1aa-cd11-b0d1-cf6cf4adafc9.png" alt="icon" class="i" role="img" height="16px" style="border:0;color:#ffffff;height:1rem;width:1rem;font-size:small;vertical-align:middle;">
                                    <span>tokukas@outlook.com</span>
                                </a>
                            </td>
                            <td>
                                <div class="vr" style="height:1.5rem;background-color:#ffffff;width:1px !important;"></div>
                            </td>
                            <td>
                                <a href="https://wa.me/+6285315360808" class="icon-btn" style="text-decoration:none;color:#ffffff;display:inline-block;text-decoration:none;color:#ffffff;display:inline-block;">
                                    <img src="https://mcusercontent.com/f0c6140a1dcf32deec8308007/images/d57a1755-874b-d489-e04d-09ce2b9d9b15.png" alt="icon" class="i" role="img" height="16px" style="border:0;color:#ffffff;height:1rem;width:1rem;font-size:small;vertical-align:middle;border:0;color:#ffffff;height:1rem;width:1rem;font-size:small;vertical-align:middle;">
                                    <span>+6285315360808</span>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <hr style="color:inherit;background-color:currentColor;border:0;opacity:0.25;height:1px;">
            <div class="section" style="text-align:center;font-size: 0.75rem;">
                <strong>&copy; 2021, TOKUKAS</strong>
                <table style="margin: 0.5rem auto; text-align: center; border-collapse: separate; border-spacing: 0.5rem 0;">
                    <tbody>
                        <tr>
                            <td>
                                <a href="<?= base_url('/terms'); ?>" class="icon-btn" style="text-decoration:none;color:#ffffff;display:inline-block;">Syarat Penggunaan</a>
                            </td>
                            <td>
                                <div class="vr" style="height:1.5rem;background-color:#ffffff;width:1px !important;height: 1rem;background-color: #ffffff; width:1px !important;">
                                </div>
                            </td>
                            <td>
                                <a href="<?= base_url('/privacy'); ?>" class="icon-btn" style="text-decoration:none;color:#ffffff;display:inline-block;">Kebijakan Privasi</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
