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
            return redirect()->to(base_url('/login/to/account'));
        }

        $accountId = $this->accountModel->getId(session('login')['email']);
        $data = [
            'title' => 'Akun Saya | TOKUKAS',
            'loginSession' => session('login'),
            'myAddresses' => $this->addressModel->myAddress($accountId, true),
        ];

        unset($accountId);
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
