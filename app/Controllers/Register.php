<?php

namespace App\Controllers;

use App\Models\AccountModel;
use App\Models\EmailVerificatorModel;

class Register extends BaseController
{
    protected $emailVerificator;
    protected $accountModel;


    public function __construct()
    {
        $this->emailVerificator = new EmailVerificatorModel();
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
        /**
         * --------------------------------------
         * Validate Email Verificator
         * --------------------------------------
         */
        $verificator = session()->getFlashdata('verificator');

        if (empty($verificator)) {
            return redirect()->to(base_url('register'));
        }

        if (!$this->emailVerificator->isVerified($verificator['id'])) {
            $this->emailVerificator->delete($verificator['id']);

            set_alert('Email anda belum terverifikasi. Harap ulangi pendaftaran akun.');
            return redirect()->to(base_url('register'));
        }

        /**
         * --------------------------------------
         * Go to create account page
         * --------------------------------------
         */
        $data = [
            'title' => 'Buat Akun | TOKUKAS',
            'validation' => $this->validation,
            'verificator' => $verificator,
        ];

        return view('register/new', $data);
    }


    public function insert()
    {
        /**
         * --------------------------------------
         * Validate Email Verificator
         * --------------------------------------
         */
        $verificatorId = $this->request->getPost('id');

        if (empty($verificatorId)) {
            return redirect()->to(base_url('register'));
        }

        if (!$this->emailVerificator->isVerified($verificatorId)) {
            $this->emailVerificator->delete($verificatorId);

            set_alert('Email anda belum terverifikasi. Harap ulangi pendaftaran akun.');
            return redirect()->to(base_url('register'));
        }

        /**
         * --------------------------------------
         * Validate Input
         * --------------------------------------
         */
        $verificator = $this->emailVerificator->find($verificatorId);

        if (!$this->validate('registerAccount')) {
            session()->setFlashdata('verificator', [
                'id' => $verificatorId,
                'email' => $verificator['email'],
            ]);
            return redirect()->to(base_url('register/new'))->withInput();
        }

        /**
         * --------------------------------------
         * Inserting account
         * --------------------------------------
         */
        $accountId = $this->accountModel->smartSave([
            'email' => htmlspecialchars($this->emailVerificator->getEmail($verificatorId)),
            'name' => ucwords(htmlspecialchars($this->request->getPost('fullname'))),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
        ]);


        // if failed, redirect to register page
        if (empty($accountId)) {
            $this->emailVerificator->delete($verificatorId);
            set_alert('Terjadi kesalahan saat mendaftarkan akun anda. Harap coba lagi.');
            return redirect()->to(base_url('register'));
        }

        // if success
        $this->emailVerificator->deleteWhere(['email' => $verificator['email']]);
        set_alert('Pendaftaran akun berhasil. Silahkan login untuk memulai transaksi.');
        return redirect()->to(base_url('login'));
    }
}
