<?php

namespace App\Controllers;

use App\Models\AccountModel;
use App\Models\AddressModel;
use App\Models\EmailVerificatorModel;
use App\Models\OfferModel;

class Offer extends BaseController
{
    protected $accountModel;
    protected $addressModel;
    protected $offerModel;

    private $newOfferDefaultSteps = ['Tentukan Lokasi Anda', 'Pilih Metode Transaksi', 'Pilih Preferensi Pembayaran', 'Upload Data Buku'];


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
            return $this->newOfferFirstStep();
        } elseif ($step === 2) {
            return $this->newOfferSecondStep();
        } elseif ($step === 3) {
            return $this->newOfferThirdStep();
        }
    }


    private function newOfferFirstStep()
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

        d(session('new_offer'));
        return view('offer/new-step-address', $data);
    }


    private function newOfferSecondStep()
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

        d(session('new_offer'));
        return view('offer/new-step-transaction', $data);
    }


    private function newOfferThirdStep()
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
            'pageDesc' => 'Pilih metode pembayaran untuk penawaran buku anda',
            'step' => [
                'list' => $this->newOfferDefaultSteps,
                'current' => 2,
            ]
        ];

        // check selected transaction method
        if ($transactionMethod === 'online') {
            $currentStep = $data['step']['current'];

            $data['step']['list']
                = array_slice($this->newOfferDefaultSteps, 0, $currentStep)
                + [$currentStep => 'Pilih Metode Pengiriman'];

            for ($i = $currentStep; $i < sizeof($this->newOfferDefaultSteps); $i++) {
                $data['step']['list'] += [$i + 1 => $this->newOfferDefaultSteps[$i]];
            }

            $data['pageDesc'] = 'Pilih metode pengiriman untuk penawaran buku anda';

            d(session('new_offer'));
            return view('offer/new-step-expedition', $data);
        }

        d(session('new_offer'));
        return view('offer/new-step-payment', $data);
    }
}
