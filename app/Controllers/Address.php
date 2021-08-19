<?php

namespace App\Controllers;

use App\Models\AddressModel;

class Address extends BaseController
{
    protected $addressModel;

    public function __construct()
    {
        $this->addressModel = new AddressModel();
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
        ];

        return view('address/new', $data);
    }


    public function insert()
    {
        if (empty($this->request->getPost())) {
            return redirect()->to(base_url('/address/new'));
        }

        return 'Inserting your address...';
    }
}
