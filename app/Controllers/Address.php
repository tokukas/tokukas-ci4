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
            return to_login_page('address');
        }

        $alert = session()->getFlashdata('alert');
        (!empty($alert)) && set_alert($alert['message'], $alert['warning']);
        unset($alert);

        return redirect()->to(base_url('account'));
    }


    public function new()
    {
        if (empty(session('login'))) {
            return to_login_page('address/new');
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
            return to_login_page('address/new');
        }

        /**
         * ----------------------------------------------------
         * VERIFY REQUEST METHOD
         * ----------------------------------------------------
         */
        $address = $this->request->getPost();
        if (empty($address)) {
            return redirect()->to(base_url('address/new'));
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
            return redirect()->back()->withInput();
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
            return redirect()->back()->withInput();
        }

        // success respons
        set_alert('Alamat baru berhasil ditambahkan.');
        return redirect()->to(base_url('address'));
    }


    public function setDefault()
    {
        if (empty($this->request->getPost())) {
            return redirect()->to(base_url('address'));
        }

        if ($this->addressModel->setDefaultAddress($this->request->getPost('address_id'))) {
            set_alert('Alamat utama berhasil diperbarui.');
        }

        return redirect()->to(base_url('address'));
    }


    public function delete($addressId)
    {
        /**
         * ----------------------------------------------------
         * VERIFY LOGIN SESSION
         * ----------------------------------------------------
         */
        if (empty(session('login'))) {
            return to_login_page('address');
        }

        /**
         * ----------------------------------------------------
         * VERIFY REQUEST METHOD
         * ----------------------------------------------------
         */
        if (empty($this->request->getPost())) {
            return redirect()->to(base_url('address'));
        }

        /**
         * ----------------------------------------------------
         * VALIDATE DATA
         * ----------------------------------------------------
         */
        if (empty($this->addressModel->find($addressId))) {
            set_alert('Alamat yang akan dihapus tidak ditemukan.', true);
        }

        /**
         * ----------------------------------------------------
         * DELETE DATA
         * ----------------------------------------------------
         */
        // handler if the target address is default address
        $accountId = $this->accountModel->getId(session('login')['email']);

        $newDefaultAddress = ($this->addressModel->isDefaultAddress($addressId))
            ? $this->addressModel->where(['account_id' => $accountId, 'is_default' => 0])->first()
            : null;

        // set new default address
        if (!empty($newDefaultAddress)) {
            $updateData['id'] = $newDefaultAddress['id'];
            $updateData['is_default'] = 1;

            if (!$this->addressModel->smartSave($updateData)) {
                // failed respons
                set_alert('Gagal memperbarui alamat utama ke alamat lain.', true);
                return redirect()->to(base_url('address'));
            }
        }

        // deleting address
        if ($this->addressModel->delete($addressId)) {
            set_alert('Satu alamat berhasil dihapus.');
        }

        unset($newDefaultAddress, $accountId);
        return redirect()->to(base_url('address'));
    }


    public function edit($addressId)
    {
        if (empty(session('login'))) {
            return to_login_page('address');
        }

        if (empty($this->addressModel->find($addressId))) {
            set_alert('Alamat yang akan diubah tidak ditemukan.', true);
            return redirect()->to(base_url('address'));
        }

        // matching the address with the user ID
        $address = $this->addressModel->find($addressId);

        if ($address['account_id'] !== $this->accountModel->getId(session('login')['email'])) {
            unset($address);
            set_alert('Anda tidak memiliki akses untuk mengubah alamat ini.', false);
            return redirect()->to(base_url('address'));
        }

        $data = [
            'title' => 'Ubah Alamat | TOKUKAS',
            'loginSession' => session('login'),
            'validation' => $this->validation,
            'oldAddress' => $address,
        ];

        return view('address/edit', $data);
    }


    public function update($addressId)
    {
        /**
         * ----------------------------------------------------
         * VERIFY LOGIN SESSION
         * ----------------------------------------------------
         */
        if (empty(session('login'))) {
            return to_login_page('address');
        }

        /**
         * ----------------------------------------------------
         * VERIFY REQUEST METHOD
         * ----------------------------------------------------
         */
        $address = $this->request->getPost();
        if (empty($address)) {
            return redirect()->to(base_url('address/edit/' . $addressId));
        }

        /**
         * ----------------------------------------------------
         * VALIDATE USER INPUT
         * ----------------------------------------------------
         */
        // get account data
        $accountId = $this->accountModel->getId(session('login')['email']);

        // get old address
        $oldAddress = $this->addressModel->find($addressId);

        // check if label value is not used yet
        $isLabelAlreadyUsed = (strtolower($address['label']) === strtolower($oldAddress['label']))
            ? false
            : $this->addressModel->isLabelAlreadyUsed($accountId, $address['label']);

        unset($accountId, $oldAddress);

        if (!$this->validate('address') || $isLabelAlreadyUsed) {
            if ($isLabelAlreadyUsed) {
                $this->validator->setError('label', 'Label \'' . $address['label'] . '\' sudah anda gunakan. Harap gunakan label lain.');
            }

            // return to the form page with the form data and validation results
            return redirect()->back()->withInput();
        }

        /**
         * ----------------------------------------------------
         * UPDATE DATA
         * ----------------------------------------------------
         */
        $updateData = [
            'id' => $addressId,
            'label' => ucwords(htmlspecialchars($address['label'])),
            'province' => strtoupper(htmlspecialchars($address['province'])),
            'regency' => strtoupper(htmlspecialchars($address['regency'])),
            'district' => ucwords(htmlspecialchars($address['district'])),
            'village' => ucwords(htmlspecialchars($address['village'])),
            'postal_code' => htmlspecialchars($address['postal_code']),
            'street' => ucwords(htmlspecialchars($address['street'])),
        ];

        if (!$this->addressModel->smartSave($updateData)) {
            set_alert('Alamat gagal diperbarui', true);
            return redirect()->back()->withInput();
        }

        set_alert('Alamat berhasil diperbarui');
        return redirect()->to(base_url('address'));
    }
}
