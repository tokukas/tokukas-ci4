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
        $loginSession = session('login');

        if (empty($loginSession)) {
            return redirect()->to(base_url('/login/to/offer'));
        }

        $data = [
            'title' => 'Daftar Penawaran | TOKUKAS',
            'loginSession' => $loginSession,
        ];

        return view('offer/list', $data);
    }
}
