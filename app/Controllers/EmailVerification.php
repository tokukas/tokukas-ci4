<?php

namespace App\Controllers;

use App\Models\EmailVerificatorModel;

class EmailVerification extends BaseController
{
    protected $emailVerificator;

    public function __construct()
    {
        $this->emailVerificator = new EmailVerificatorModel();
    }


    public function requestCode()
    {
        /**
         * --------------------------------------
         * Validate Input
         * --------------------------------------
         */
        if (!$this->validate('registerEmail')) {
            return redirect()->to(base_url('register'))->withInput();
        }

        // get the email address
        $emailAddress = strtolower(htmlspecialchars($this->request->getPost('email')));

        // checking request limit for this email
        if ($this->emailVerificator->isRequestsReachesLimit($emailAddress)) {
            set_alert('Anda sudah terlalu banyak mencoba mendaftar hari ini. Silahkan coba lagi setelah 24 jam.', true);
            return redirect()->to(base_url('register'))->withInput();
        }

        /**
         * --------------------------------------
         * Generate Verification Code
         * --------------------------------------
         */
        $code = code_generator(6);
        $id = $this->emailVerificator->smartSave([
            'email' => $emailAddress,
            'code' => password_hash($code, PASSWORD_BCRYPT),
        ]);

        if ($id === false) {
            set_alert('Gagal menghasilkan kode verifikasi. Harap tunggu beberapa saat lalu coba lagi.', true);
            return redirect()->to(base_url('register'))->withInput();
        }

        /**
         * --------------------------------------
         * Send Verification Email
         * --------------------------------------
         */
        // set email properties
        $emailId = $this->variable->getVar('comp_email_id');
        $senderEmail = $this->emailVerificator->getCompanyEmail($emailId);

        // set email config
        $config['protocol'] = 'smtp';
        $config['SMTPUser'] = $senderEmail['email'];
        $config['SMTPPass'] = $senderEmail['password'];
        $config['SMTPHost'] = $senderEmail['host'];
        $config['SMTPPort'] = (int)$senderEmail['port'];
        $config['SMTPCrypto'] = ((int)$senderEmail['port'] === 465) ? null : $senderEmail['crypto'];
        $this->email->initialize($config);

        // set sender email
        $this->email->setFrom($senderEmail['email'], $senderEmail['name']);

        // set recipient email
        $this->email->setTo($emailAddress);

        // set the email to be sent
        $emailTemplateFile = view('layouts/templates/email/verification-code', [
            'recipient' => $emailAddress,
            'verificationCode' => $code,
            'minutesUntilCodeExpires' => $this->emailVerificator->getMinutesUntilCodeExpires(),
        ]);
        $this->email->setSubject('Verifikasi Email');
        $this->email->setMessage($emailTemplateFile);

        /**
         * --------------------------------------
         * Send the email & get the respons
         * --------------------------------------
         */
        // send the email
        if ($this->email->send(false)) {
            // redirect to verification page
            $this->email->clear();
            session()->setFlashdata('verificationId', $id);
            return redirect()->to(base_url('register/verify'));
        }

        // if email failed to send
        $this->emailVerificator->delete($id);    // deleting verificator

        print_console($this->email->printDebugger(['headers']), true);
        $this->email->clear();

        set_alert('Kode verifikasi gagal dikirim. Harap tunggu beberapa saat lalu coba lagi.', true);
        return redirect()->to(base_url('register'))->withInput();
    }


    public function verify()
    {
        /**
         * --------------------------------------
         * Validate Verificator
         * --------------------------------------
         */
        // get verificator id
        $id = $this->request->getPost('verification_id') ?: session()->getFlashdata('verificationId');

        // if id is empty, redirect to register page
        if (empty($id)) {
            return redirect()->to(base_url('register'));
        }

        // get verificator
        $verificator = $this->emailVerificator->find($id);

        // checking if verificator is valid
        if ($verificator === null) {
            set_alert('Kode verifikasi tidak valid. Silahkan ulangi pendaftaran akun.', true);
            return redirect()->to(base_url('register'));
        }

        // checking if verificator is not expired
        if ($this->emailVerificator->isCodeExpired($id)) {
            // deleting verificator
            $this->emailVerificator->delete($id);

            // redirect to register page
            set_alert('Kode verifikasi sudah kadaluwarsa. Silahkan ulangi pendaftaran akun.', true);
            return redirect()->to(base_url('register'));
        }

        /**
         * --------------------------------------
         * Validate Verification Code
         * --------------------------------------
         */
        // get the verification code
        $verificationCode = $this->request->getPost('verification_code');

        if (empty($verificationCode)) {
            $data = [
                'title' => 'Verifikasi Email | TOKUKAS',
                'pageDesc' => 'Masukkan kode verifikasi untuk dapat membuat akun anda',
                'variable' => $this->variable,
                'verificator' => [
                    'id' =>  $id,
                    'email' => $verificator['email'],
                ],
            ];

            return view('register/verify', $data);
        }

        // verify the code
        $valid = $this->emailVerificator->verifyCode($id, $verificationCode);

        /**
         * --------------------------------------
         * Validation Respons
         * --------------------------------------
         */
        // === back to email verification page, if code invalid or if empty.
        if (!$valid) {
            // set warning alert
            set_alert('Kode verifikasi yang anda masukkan salah.', true);

            // redirect to verification page
            session()->setFlashdata('verificationId', $id);
            return redirect()->to(base_url('register/verify'));
        }

        // === if validation code is verified, redirect to account registration page.
        // update verification status
        $this->emailVerificator->smartSave([
            'id' => $id,
            'verified' => true,
        ]);

        session()->setFlashdata('verificator', [
            'id' => $id,
            'email' => $verificator['email']
        ]);
        return redirect()->to(base_url('register/new'));
    }
}
