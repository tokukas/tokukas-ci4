<?php

namespace App\Controllers;

use App\Models\AccountModel;

class Login extends BaseController
{
    protected $accountModel;


    public function __construct()
    {
        $this->accountModel = new AccountModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Masuk | TOKUKAS',
        ];

        return view('login/index', $data);
    }


    public function auth()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        return 'Access granted';
    }
}
