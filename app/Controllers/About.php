<?php

namespace App\Controllers;

class About extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Tentang Kami | TOKUKAS'
        ];

        return view('about/index', $data);
    }
}
