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

        $alert = session()->getFlashdata('alert');
        (!empty($alert)) && set_alert($alert['message'], $alert['warning']);
        unset($alert);

        return redirect()->to(base_url('/account'));
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
        $accountId = $this->accountModel->getId(session('login')['email']);

        // check if label value is not used yet
        $isLabelAlreadyUsed = $this->addressModel->isLabelAlreadyUsed($accountId, $address['label']);

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
            'account_id' => $accountId,
            'label' => ucwords(htmlspecialchars($address['label'])),
            'province' => strtoupper(htmlspecialchars($address['province'])),
            'regency' => strtoupper(htmlspecialchars($address['regency'])),
            'district' => ucwords(htmlspecialchars($address['district'])),
            'village' => ucwords(htmlspecialchars($address['village'])),
            'postal_code' => htmlspecialchars($address['postal_code']),
            'street' => ucwords(htmlspecialchars($address['street'])),
        ]);

        // set to default address if there are no other address.
        if ($this->addressModel->countMyAddress($accountId) === 1) {
            $this->addressModel->smartSave(['id' => $addressId, 'is_default' => 1]);
        }

        unset($accountId, $address);

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


    public function setDefault()
    {
        if (empty($this->request->getPost())) {
            return redirect()->to(base_url('/address'));
        }

        if ($this->addressModel->setDefaultAddress($this->request->getPost('address_id'))) {
            set_alert('Alamat utama berhasil diperbarui.');
        }

        return redirect()->to(base_url('/address'));
    }
}
