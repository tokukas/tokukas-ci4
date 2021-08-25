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
        $redirect = $this->request->getVar('to');

        /**
         * --------------------------------------
         * Check login cookie
         * --------------------------------------
         */
        $loginCookie = $this->getLoginCookie();
        if (!empty($loginCookie)) {
            session()->set('login', $loginCookie);
            return $this->afterLogin($redirect);
        }

        /**
         * --------------------------------------
         * Check login session
         * --------------------------------------
         */
        if (!empty(session('login'))) {
            return $this->afterLogin($redirect);
        }

        $data = [
            'title' => 'Masuk | TOKUKAS',
            'validation' => $this->validation,
            'pageDesc' => 'Masuk ke TOKUKAS menggunakan email anda yang sudah terdaftar.',
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
            return redirect()->back()->withInput();
        }

        /**
         * --------------------------------------
         * Authentication
         * --------------------------------------
         */
        if (!$this->accountModel->verify($email, $password)) {
            set_alert('Email atau kata sandi anda salah.', true);
            return redirect()->back()->withInput();
        }

        /**
         * --------------------------------------
         * Make login session & cookie
         * --------------------------------------
         */
        $account = $this->accountModel->findByEmail($email);

        // set session
        session()->set('login', [
            'email' => $account['email'],
            'name' => $account['name']
        ]);

        // set cookie
        if (!empty($rememberMe)) {
            $this->setLoginCookie($account['id'], $account['email']);
        }

        unset($account);

        /**
         * --------------------------------------
         * Login success
         * --------------------------------------
         */
        set_alert('Anda berhasil login');
        return $this->afterLogin($redirect);
    }


    public function logout()
    {
        /**
         * --------------------------------------
         * Destroying cookie
         * --------------------------------------
         */
        $cookieConfig = [
            'expires' => time() - HOUR,
            'path' => '/login',
        ];
        setcookie('auth_lock', '', $cookieConfig);
        setcookie('auth_key', '', $cookieConfig);

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
        return redirect()->to(base_url());
    }


    protected function setLoginCookie($id, $email)
    {
        // set the login cookie config
        $cookieConfig = [
            'expires' => time() + DAY,
            'path' => '/login',
        ];

        setcookie('auth_lock', $id, $cookieConfig);
        setcookie('auth_key', password_hash($email, PASSWORD_BCRYPT), $cookieConfig);
    }


    protected function getLoginCookie()
    {
        $verifiedLoginCookie = null;

        // get the login cookie
        $loginCookie = [
            'id' => $_COOKIE['auth_lock'] ?? null,
            'email' => $_COOKIE['auth_key'] ?? null,
        ];

        // verified the cookie
        $account = (empty($loginCookie['id']) || empty($loginCookie['email']))
            ? null
            : $this->accountModel->find($loginCookie['id']);

        if (!empty($account)) {
            if (password_verify($account['email'], $loginCookie['email'])) {
                $verifiedLoginCookie = [
                    'email' => $account['email'],
                    'name' => $account['name'],
                ];
            }
        }

        // the result
        unset($account);
        return $verifiedLoginCookie;
    }


    protected function afterLogin($destination = '')
    {
        return (empty($destination))
            ? redirect()->to(base_url())
            : redirect()->to(base_url($destination));
    }
}
