<?php

namespace App\Controllers;

class Offer extends BaseController
{
    public function index()
    {
        /**
         * --------------------------------------
         * Validate Login Session
         * --------------------------------------
         */
        if (empty(session('login'))) {
            return toLoginPage('offer');
        }

        $data = [
            'title' => 'Daftar Penawaran | TOKUKAS',
            'loginSession' => session('login'),
        ];

        return view('offer/list', $data);
    }
}
