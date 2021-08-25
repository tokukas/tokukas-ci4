<?php

namespace App\Controllers;

class Sell extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Jual Buku | TOKUKAS',
            'loginSession' => session('login'),
            'variable' => $this->variable,
            'pageDesc' => 'Punya buku bekas atau buku yang sudah tidak terpakai? Jual buku anda ke TOKUKAS.',
        ];

        return view('sell/index', $data);
    }
}
