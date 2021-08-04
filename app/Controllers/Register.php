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
        // return view('layouts/templates/two-sides', $data);
    }
}
