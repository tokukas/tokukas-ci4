<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Masuk | TOKUKAS'
        ];

        return view('login/index', $data);
    }


    public function auth()
    {
        d($this->request->getPost());
        return 'Access granted';
    }
}
