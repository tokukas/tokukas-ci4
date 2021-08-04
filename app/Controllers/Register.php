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


    public function auth()
    {
        d($this->request->getPost());
        return 'Masukkan kode verifikasi yang kami kirimkan ke email anda.';
    }
}
