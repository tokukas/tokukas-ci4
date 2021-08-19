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
        $loginSession = session('login');

        if (empty($loginSession)) {
            return redirect()->to(base_url('/login/to/account'));
        }

        $data = [
            'title' => 'Akun Saya | TOKUKAS',
            'loginSession' => $loginSession,
        ];

        return view('account/index', $data);
    }


    public function change($field)
    {
        $loginSession = session('login');

        if (empty($loginSession)) {
            return redirect()->to(base_url('/login/to/account'));
        }

        $myAccount = $this->accountModel->findByEmail($loginSession['email']);

        dd($field, $myAccount);
    }
}
