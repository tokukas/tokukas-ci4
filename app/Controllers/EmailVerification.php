<?php

namespace App\Controllers;

use App\Models\EmailVerificatorModel;
use CodeIgniter\Config\Services;

class EmailVerification extends BaseController
{
    protected $email;
    protected $emailVerificator;

    /**
     * The sender name.
     * @var string
     */
    protected $senderName;

    /**
     * The sender email address.
     *
     * Need outlook email, or change email configuration file if not using outlook email.
     * @var string
     */
    protected $senderEmailAddress;

    /**
     * The sender email password.
     * @var string
     */
    protected $senderPassword;


    public function __construct()
    {
        $this->email = Services::email();
        $this->emailVerificator = new EmailVerificatorModel();
    }


    public function requestCode()
    {
        /**
         * --------------------------------------
         * Validate Input
         * --------------------------------------
         */
        if (!$this->validate('formRegister')) {
            return redirect()->to(base_url('/register'))->withInput();
        }

        // get the email address
        $emailAddress = $this->request->getPost('email');

        // validate email
        if (!$this->email->isValidEmail($emailAddress)) {
            set_alert('Email ini tidak valid.', true);
            return redirect()->to(base_url('register'))->withInput();
        }

        /**
         * --------------------------------------
         * Generate Verificator
         * --------------------------------------
         */
        $id = $this->emailVerificator->generateCode($emailAddress);

        if ($id === false) {
            set_alert('Gagal menghasilkan kode verifikasi. Harap tunggu beberapa saat lalu coba lagi.', true);
            return redirect()->to(base_url('register'))->withInput();
        }

        $verificationCode = $this->emailVerificator->getCode($id);

        /**
         * --------------------------------------
         * Send Verification Email
         * --------------------------------------
         */
        // set sender email
        $this->senderName = $this->variable->getVar('comp_name');
        $this->senderEmailAddress = $this->variable->getVar('comp_email_address');
        $this->senderPassword = $this->variable->getVar('comp_password_email');

        // set email config
        $config['SMTPUser'] = $this->senderEmailAddress;
        $config['SMTPPass'] = $this->senderPassword;
        $this->email->initialize($config);

        $this->email->setFrom($this->senderEmailAddress, $this->senderName);

        // set recipient email
        $this->email->setTo($emailAddress);

        // set the email to be sent
        $emailTemplateFile = view('layouts/templates/verification-code-email', [
            'recipient' => $emailAddress,
            'verificationCode' => $verificationCode,
            'minutesUntilCodeExpires' => $this->emailVerificator->getMinutesUntilCodeExpires(),
        ]);
        $this->email->setSubject('Verifikasi Email');
        $this->email->setMessage($emailTemplateFile);

        /**
         * --------------------------------------
         * Respons
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


    public function new()
    {
    }
}
