<?php

namespace App\Controllers;

use App\Models\AccountModel;
use App\Models\AddressModel;
use App\Models\OfferModel;

class Offer extends BaseController
{
    protected $accountModel;
    protected $addressModel;
    protected $offerModel;

    private $newOfferDefaultSteps = ['Tentukan Lokasi Anda', 'Pilih Metode Transaksi', 'Pilih Metode Pengiriman', 'Pilih Metode Pembayaran', 'Upload Data Buku'];
    private $validShippingMethods = ['sicepat ekspres', 'anteraja', 'idexpress', 'j&t express', 'jne express', 'tiki'];

    public function __construct()
    {
        $this->addressModel = new AddressModel();
        $this->accountModel = new AccountModel();
        $this->offerModel = new OfferModel();
    }


    public function index()
    {
        /**
         * --------------------------------------
         * Validate Login Session
         * --------------------------------------
         */
        if (empty(session('login'))) {
            return to_login_page('offer');
        }

        $data = [
            'title' => 'Daftar Penawaran | TOKUKAS',
            'loginSession' => session('login'),
            'variable' => $this->variable,
            'pageDesc' => 'Buat penawaran buku anda'
        ];

        return view('offer/list', $data);
    }


    public function new($step = '')
    {
        /**
         * --------------------------------------
         * Validate Login Session
         * --------------------------------------
         */
        if (empty(session('login'))) {
            return to_login_page('offer/new');
        }

        /**
         * --------------------------------------
         * Form Routing
         * --------------------------------------
         */
        $step = (int) $step ?: 1;

        if ($step === 1) {
            return $this->newOfferLocationStep();
        } elseif ($step === 2) {
            return $this->newOfferTransactionStep();
        } elseif ($step === 3) {
            return $this->newOfferShippingStep();
        } elseif ($step === 4) {
            return $this->newOfferPaymentStep();
        } elseif ($step === 5) {
            return $this->newOfferBookStep();
        }
    }


    private function newOfferLocationStep()
    {
        $accountId = $this->accountModel->getId(session('login')['email']);

        $data = [
            'title' => 'Buat Penawaran | TOKUKAS',
            'loginSession' => session('login'),
            'variable' => $this->variable,
            'pageDesc' => 'Tentukan alamat untuk penawaran buku anda',
            'step' => [
                'list' => $this->newOfferDefaultSteps,
                'current' => 0,
            ],
            'myAddresses' => $this->addressModel->myAddresses($accountId, true),
        ];

        if (empty(session('new_offer'))) {
            $data['selectedAddressId'] = $this->addressModel->getDefaultAddress($accountId, true)['id'];
        } else {
            $data['selectedAddressId'] = session('new_offer')['address_id'] ?: null;
        }

        return view('offer/new-step-address', $data);
    }


    private function newOfferTransactionStep()
    {
        // --------------------------------------
        // Validate The Address
        // --------------------------------------
        $addressId = htmlspecialchars($this->request->getPost('address_id'));

        if (empty($addressId)) {
            $addressId = empty(session('new_offer')) ? null : session('new_offer')['address_id'] ?? null;
        }

        $address = $this->addressModel->find($addressId, true);

        if (empty($address)) {
            set_alert('Alamat tidak dapat ditemukan', true);
            return redirect()->to(base_url('offer/new'));
        }

        // --------------------------------------
        // Update The Form Session
        // --------------------------------------
        $transactionMethod = empty(session('new_offer')) ? null : session('new_offer')['transaction_method'] ?? null;

        empty($transactionMethod) && session()->set('new_offer', []);
        session()->push('new_offer', ['address_id' => $address['id']]);

        $data = [
            'title' => 'Buat Penawaran | TOKUKAS',
            'loginSession' => session('login'),
            'variable' => $this->variable,
            'pageDesc' => 'Pilih metode transaksi untuk penawaran buku anda',
            'step' => [
                'list' => $this->newOfferDefaultSteps,
                'current' => 1,
            ],
            'selectedTransactionMethod' => $transactionMethod ?: 'online',
            'canChoose' => strpos(strtoupper($address['stringified']), 'KABUPATEN INDRAMAYU'),
        ];

        return view('offer/new-step-transaction', $data);
    }


    private function newOfferShippingStep()
    {
        // --------------------------------------
        // Validate The Transaction Method
        // --------------------------------------
        $transactionMethod = htmlspecialchars($this->request->getPost('transaction_method'));

        if (empty($transactionMethod)) {
            $transactionMethod = empty(session('new_offer')) ? null : session('new_offer')['transaction_method'] ?? null;
        }

        if (!in_array(strtolower($transactionMethod), ['online', 'offline'])) {
            set_alert('Metode transaksi tidak valid', true);
            return redirect()->back();
        }

        // --------------------------------------
        // Update The Form Session
        // --------------------------------------
        session()->push('new_offer', ['transaction_method' => $transactionMethod]);

        $data = [
            'title' => 'Buat Penawaran | TOKUKAS',
            'loginSession' => session('login'),
            'variable' => $this->variable,
            'pageDesc' => 'Pilih metode pengiriman untuk penawaran buku anda',
            'step' => [
                'list' => $this->newOfferDefaultSteps,
                'current' => 2,
            ],
            'transactionMethod' => $transactionMethod,
        ];

        return view('offer/new-step-expedition', $data);
    }


    private function newOfferPaymentStep()
    {
        // --------------------------------------
        // Validate The Shipping Method
        // --------------------------------------
        $transactionMethod = empty(session('new_offer')) ? null : session('new_offer')['transaction_method'] ?? null;
        $shippingMethod = htmlspecialchars($this->request->getPost('shipping_method'));

        if (empty($shippingMethod)) {
            $shippingMethod = empty(session('new_offer')) ? null : session('new_offer')['shipping_method'] ?? null;
        }

        if (!in_array(strtolower($shippingMethod), $this->validShippingMethods) && $transactionMethod === 'online') {
            set_alert('Metode pengiriman tidak valid', true);
            return redirect()->back();
        }

        // --------------------------------------
        // Update The Form Session
        // --------------------------------------
        session()->push('new_offer', ['shipping_method' => $shippingMethod]);

        $data = [
            'title' => 'Buat Penawaran | TOKUKAS',
            'loginSession' => session('login'),
            'variable' => $this->variable,
            'pageDesc' => 'Pilih metode pembayaran untuk penawaran buku anda',
            'step' => [
                'list' => $this->newOfferDefaultSteps,
                'current' => 3,
            ],
        ];

        return view('offer/new-step-payment', $data);
    }


    private function newOfferBookStep()
    {
        dd(session('new_offer'), $this->request->getPost());
    }
}
