<?php

namespace App\Controllers;

use App\Models\AccountModel;
use App\Models\EmailVerificationModel;

class Register extends BaseController
{
    protected $emailVerificator;
    protected $accountModel;

    public function __construct()
    {
        $this->emailVerificator = new EmailVerificationModel();
        $this->accountModel = new AccountModel();
    }


    public function index()
    {
        $data = [
            'title' => 'Daftar | TOKUKAS',
            'validation' => $this->validation
        ];

        return view('register/index', $data);
    }


    public function new()
    {
        $verificator = session()->getFlashdata('verificator');

        if (empty($verificator)) {
            return redirect()->to(base_url('/register'));
        }
        dd($verificator);
    }
}
