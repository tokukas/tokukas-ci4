<?php

namespace App\Controllers;

use App\Models\AccountModel;
use CodeIgniter\I18n\Time;

class Login extends BaseController
{
    protected $accountModel;


    public function __construct()
    {
        $this->accountModel = new AccountModel();
    }

    public function index($redirect = '')
    {
        /**
         * --------------------------------------
         * TODO: Check login cookie
         * --------------------------------------
         */
        // code here...

        /**
         * --------------------------------------
         * Check login session
         * --------------------------------------
         */
        $loginSession = session('login');

        if (!empty($loginSession)) {
            $this->loginSession = $loginSession;
            return $this->afterLogin($redirect);
        }

        $data = [
            'title' => 'Masuk | TOKUKAS',
            'validation' => $this->validation,
            'redirect' => $redirect,
        ];

        return view('login/index', $data);
    }


    public function auth()
    {
        /**
         * --------------------------------------
         * Validate Input
         * --------------------------------------
         */
        $email = htmlspecialchars($this->request->getPost('email'));
        $password = $this->request->getPost('password');
        $rememberMe = $this->request->getPost('remember_me');
        $redirect = htmlspecialchars($this->request->getPost('redirect'));

        if (!$this->validate('login')) {
            return redirect()->to(base_url('/login'))->withInput();
        }

        /**
         * --------------------------------------
         * Authentication
         * --------------------------------------
         */
        if (!$this->accountModel->verify($email, $password)) {
            set_alert('Email atau kata sandi anda salah.', true);
            return redirect()->to(base_url('/login'))->withInput();
        }

        /**
         * --------------------------------------
         * Make login session & cookie
         * --------------------------------------
         */
        // set session
        $account = $this->accountModel->findByEmail($email);
        session()->set('login', ['email' => $account['email'], 'name' => $account['name']]);
        unset($account);

        // set cookie
        if (!empty($rememberMe)) {
            // TODO: set cookie
            // $cookieOptions = [
            //     'expires' => time() + DAY,
            //     'path' => '/'
            // ];

            // setcookie('login_id', $account['id'], $cookieOptions);
            // setcookie('login_email', $emailHash, $cookieOptions);
        }

        /**
         * --------------------------------------
         * Login success
         * --------------------------------------
         */
        set_alert('Anda berhasil login');
        return $this->afterLogin($redirect);
    }


    protected function setLoginCookie($id, $emailHash)
    {
        // TODO: set the login cookie
    }


    protected function getLoginCookie()
    {
        $loginCookie = null;     // TODO: get the login cookie
        $verifiedLoginCookie = null;

        if (!empty($loginCookie)) {
            $account = $this->accountModel->find($loginCookie['id']);

            if (password_verify($account['email'], $loginCookie['email'])) {
                $verifiedLoginCookie = [
                    'email' => $account['email'],
                    'name' => $account['name'],
                ];
            }

            unset($account);
        }

        return $verifiedLoginCookie;
    }


    protected function afterLogin($destination = '')
    {
        return (empty($destination))
            ? redirect()->to(base_url('/'))
            : redirect()->to(base_url($destination));
    }
}
