<?php

namespace App\Controllers;

class Logout extends BaseController
{
    public function index()
    {
        /**
         * --------------------------------------
         * Destroying session
         * --------------------------------------
         */
        session()->destroy();

        /**
         * --------------------------------------
         * Back to home
         * --------------------------------------
         */
        return redirect()->to(base_url('/'));
    }
}
