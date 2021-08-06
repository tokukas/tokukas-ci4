<?php

namespace App\Controllers;

use App\Models\EmailVerificatorModel;
use CodeIgniter\Config\Services;

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
            return redirect()->to(base_url('/register'))->withInput();
        }

        // get the email address
        $emailAddress = strtolower(htmlspecialchars($this->request->getPost('email')));

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
        // set sender email
        $this->email->setFrom($this->senderEmailAddress, $this->senderName);

        // set recipient email
        $this->email->setTo($emailAddress);

        // set the email to be sent
        $emailTemplateFile = view('layouts/templates/verification-code-email', [
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
        if ($this->email->send()) {
            // redirect to verification page
            session()->setFlashdata('verificationId', $id);
            return redirect()->to(base_url('/register/verify'));
        }

        // if email failed to send
        $this->emailVerificator->delete($id);    // deleting verificator

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
            return redirect()->to(base_url('/register'));
        }

        // get verificator
        $verificator = $this->emailVerificator->find($id);

        // checking if verificator is valid
        if ($verificator === null) {
            set_alert('Kode verifikasi tidak valid. Silahkan ulangi pendaftaran akun.', true);
            return redirect()->to(base_url('/register'));
        }

        // checking if verificator is not expired
        if ($this->emailVerificator->isCodeExpired($id)) {
            // deleting verificator
            $this->emailVerificator->delete($id);

            // redirect to register page
            set_alert('Kode verifikasi sudah kadaluwarsa. Silahkan ulangi pendaftaran akun.', true);
            return redirect()->to(base_url('/register'));
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
            return redirect()->to(base_url('/register/verify/'));
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
        return redirect()->to(base_url('/register/new'));
    }
}
