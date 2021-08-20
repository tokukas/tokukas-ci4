<?php

namespace App\Controllers;

use App\Models\AccountModel;

class Account extends BaseController
{
    protected $accountModel;

    public function __construct()
    {
        $this->accountModel = new AccountModel();
    }


    public function index()
    {
        if (empty(session('login'))) {
            return redirect()->to(base_url('/login/to/account'));
        }

        $data = [
            'title' => 'Akun Saya | TOKUKAS',
            'loginSession' => session('login'),
        ];

        return view('account/index', $data);
    }


    public function change($field)
    {
        if (empty(session('login'))) {
            return redirect()->to(base_url('/login/to/account'));
        }

        $myAccount = $this->accountModel->findByEmail(session('login')['email']);

        dd($field, $myAccount);
    }
}
