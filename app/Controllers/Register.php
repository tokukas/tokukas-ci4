<?php

namespace App\Controllers;

class Register extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Daftar | TOKUKAS'
        ];

        return view('register/index', $data);
    }


    public function verify($verificationId = '')
    {
        if (empty($verificationId)) {

            // TODO: generate verification code

            // TODO: insert verification code to Email Varification Table

            $data = [
                'title' => 'Verifikasi | TOKUKAS',
                'verificationId' => uniqid(),
                'email' => $this->request->getPost('email'),
            ];

            return view('register/verify', $data);
        }

        // TODO: get the code
        $verificationCode = $this->request->getPost('verification_code');
        $email = $this->request->getPost('email');

        // TODO: check if verification id is exist

        // TODO: match the verification code with the verification id
        d($verificationCode);

        $data = [
            'title' => 'Buat Akun | TOKUKAS',
            'email' => $email,
            'verificationId' => $verificationId,
        ];

        return view('register/new', $data);
    }


    public function new()
    {
    }
}
