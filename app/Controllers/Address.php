<?php

namespace App\Controllers;

use App\Models\AccountModel;
use App\Models\AddressModel;

class Address extends BaseController
{
    protected $addressModel;
    protected $accountModel;

    public function __construct()
    {
        $this->addressModel = new AddressModel();
        $this->accountModel = new AccountModel();
    }

    public function index()
    {
        if (empty(session('login'))) {
            return redirect()->to(base_url('/login/to/address'));
        }

        $data = [
            'title' => 'Alamat Saya | TOKUKAS',
            'loginSession' => session('login'),
        ];

        return view('address/index', $data);
    }


    public function new()
    {
        if (empty(session('login'))) {
            return redirect()->to(base_url('/login/to/address/new'));
        }

        $data = [
            'title' => 'Tambah Alamat | TOKUKAS',
            'loginSession' => session('login'),
            'validation' => $this->validation,
        ];

        return view('address/new', $data);
    }


    public function insert()
    {
        /**
         * ----------------------------------------------------
         * VERIFY LOGIN SESSION
         * ----------------------------------------------------
         */
        if (empty(session('login'))) {
            return redirect()->to(base_url('/login/to/address/new'));
        }

        /**
         * ----------------------------------------------------
         * VERIFY REQUEST METHOD
         * ----------------------------------------------------
         */
        $address = $this->request->getPost();
        if (empty($address)) {
            return redirect()->to(base_url('/address/new'));
        }


        /**
         * ----------------------------------------------------
         * VALIDATE USER INPUT
         * ----------------------------------------------------
         */
        // get account data
        $account = $this->accountModel->findByEmail(session('login')['email']);

        // check if label value is not used yet
        $isLabelAlreadyUsed = $this->addressModel->isLabelAlreadyUsed($account['id'], $address['label']);

        if (!$this->validate('address') || $isLabelAlreadyUsed) {
            if ($isLabelAlreadyUsed) {
                $this->validator->setError('label', 'Label \'' . $address['label'] . '\' sudah anda gunakan. Harap gunakan label lain.');
            }

            // return to the form page with the form data and validation results
            return redirect()->to(base_url('/address/new'))->withInput();
        }

        /**
         * ----------------------------------------------------
         * INSERT DATA
         * ----------------------------------------------------
         */
        $addressId = $this->addressModel->smartSave([
            'account_id' => $account['id'],
            'label' => ucwords(htmlspecialchars($address['label'])),
            'province' => strtoupper(htmlspecialchars($address['province'])),
            'regency' => strtoupper(htmlspecialchars($address['regency'])),
            'district' => ucwords(htmlspecialchars($address['district'])),
            'village' => ucwords(htmlspecialchars($address['village'])),
            'postal_code' => htmlspecialchars($address['postal_code']),
            'street' => ucwords(htmlspecialchars($address['street'])),
        ]);

        unset($account, $address);

        /**
         * ----------------------------------------------------
         * GIVE RESPONS / FEEDBACK
         * ----------------------------------------------------
         */
        if (empty($addressId)) {
            // failed respons
            set_alert('Terjadi kesalahan saat menyimpan alamat anda. Coba lagi beberapa saat.', true);
            return redirect()->to(base_url('/address/new'))->withInput();
        }

        // success respons
        set_alert('Alamat baru berhasil ditambahkan.');
        return redirect()->to(base_url('/address'));
    }
}
