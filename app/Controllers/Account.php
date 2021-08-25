<?php

namespace App\Controllers;

use App\Models\AccountModel;
use App\Models\AddressModel;

class Account extends BaseController
{
    protected $accountModel;
    protected $addressModel;

    public function __construct()
    {
        $this->accountModel = new AccountModel();
        $this->addressModel = new AddressModel();
    }


    public function index()
    {
        if (empty(session('login'))) {
            return to_login_page('account');
        }

        $accountId = $this->accountModel->getId(session('login')['email']);
        $data = [
            'title' => 'Akun Saya | TOKUKAS',
            'loginSession' => session('login'),
            'variable' => $this->variable,
            'pageDesc' => 'Informasi Akun ' . session('login')['name'] . ' | TOKUKAS',
            'myAddresses' => $this->addressModel->myAddresses($accountId, true),
        ];

        unset($accountId);
        return view('account/index', $data);
    }


    public function change($field)
    {
        if (empty(session('login'))) {
            return to_login_page('account');
        }

        $myAccount = $this->accountModel->findByEmail(session('login')['email']);

        dd($field, $myAccount);
    }
}
