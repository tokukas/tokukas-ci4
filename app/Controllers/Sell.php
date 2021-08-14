<?php

namespace App\Controllers;

class Sell extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Jual Buku | TOKUKAS',
            'loginSession' => session('login'),
        ];

        return view('sell/index', $data);
    }
}
