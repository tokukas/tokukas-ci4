<?php

namespace App\Controllers;

use App\Models\EmailVerificationModel;

class EmailVerification extends BaseController
{
    protected $emailVerificator;

    public function __construct()
    {
        $this->emailVerificator = new EmailVerificationModel();
    }


    public function requestCode()
    {
        // validate input
        if (!$this->validate('formRegister')) {
            return redirect()->to(base_url('/register'))->withInput();
        }

        // get the email
        $email = $this->request->getPost('email');

        // generate verification code
        $id = $this->emailVerificator->generateCode($email);

        // TODO: send verification email
        $verificationCode = $this->emailVerificator->getCode($id);
        // code here...

        // redirect to verification page
        session()->setFlashdata('verificationId', $id);
        return redirect()->to(base_url('/register/verify/'));
    }


    public function verify()
    {
        // get verificator id
        $id = session()->getFlashdata('verificationId') ?: $this->request->getPost('verification_id');

        // if id is empty, redirect to register page
        if (empty($id)) {
            return redirect()->to(base_url('/register'));
        }

        // get verificator
        $verificator = $this->emailVerificator->find($id);

        // checking if verificator is valid
        if ($verificator === null) {
            set_alert('Kode verifikasi tidak valid.', true);
            return redirect()->to(base_url('/register'));
        }

        // checking if verificator is not expired
        if ($this->emailVerificator->isCodeExpired($id)) {
            set_alert('Kode verifikasi sudah kadaluwarsa.', true);
            return redirect()->to(base_url('/register'));
        }

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

        // === back to email verification page, if code invalid or if empty.
        if (!$valid) {
            // set warning alert
            set_alert('Kode verifikasi yang anda masukkan salah.', true);

            // redirect to verification page
            session()->setFlashdata('verificationId', $id);
            return redirect()->to(base_url('/register/verify/'));
        }

        // === if validation code is verified, redirect to account creation page.
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


    public function new()
    {
    }
}
