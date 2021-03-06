<?php

namespace App\Controllers;

use App\Models\AccountModel;
use App\Models\AddressModel;
use App\Models\ExpeditionModel;
use App\Models\OfferModel;
use App\Models\PaymentMethodModel;

class Offer extends BaseController
{
    protected $accountModel;
    protected $addressModel;
    protected $offerModel;
    protected $expeditionModel;
    protected $paymentMethod;

    private $newOfferDefaultSteps = ['Tentukan Lokasi Anda', 'Pilih Metode Transaksi', 'Pilih Metode Pengiriman', 'Pilih Metode Pembayaran', 'Upload Data Buku'];


    public function __construct()
    {
        $this->addressModel = new AddressModel();
        $this->accountModel = new AccountModel();
        $this->offerModel = new OfferModel();
        $this->expeditionModel = new ExpeditionModel();
        $this->paymentMethod = new PaymentMethodModel();
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


    public function new(int $step = 1)
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
        $offerSession = session('new_offer');

        if (!empty($offerSession)) {
            if ($step === 2 && !empty($offerSession['address_id'])) {
                return $this->newOfferTransactionStep();
            } elseif ($step === 3 && !empty($offerSession['transaction_method'])) {
                return $this->newOfferShippingStep();
            } elseif ($step === 4 && !empty($offerSession['expedition_id'])) {
                return $this->newOfferPaymentStep();
            } elseif ($step === 5 && !empty($offerSession['payment_id'])) {
                return $this->newOfferBookStep();
            }
        }

        return $this->newOfferLocationStep();
    }


    public function cancelNewOffer()
    {
        session()->remove('new_offer');
        return redirect()->to(base_url('offer'));
    }


    private function newOfferLocationStep()
    {
        // --------------------------------------
        // Validate The Request
        // --------------------------------------
        if (!empty($this->request->getPost('address_id'))) {
            // updating offer session
            $addressId = htmlspecialchars($this->request->getPost('address_id'));

            if (empty($this->addressModel->find($addressId, true))) {
                set_alert('Alamat tidak dapat ditemukan', true);
                return redirect()->to(base_url('offer/new'));
            }

            session()->set('new_offer', ['address_id' => $addressId]);
            return redirect()->to(base_url('offer/new/2'));
        }

        // --------------------------------------
        // Go to view
        // --------------------------------------
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

        $data['selectedAddressId'] = empty(session('new_offer')) || empty(session('new_offer')['address_id'])
            ? $this->addressModel->getDefaultAddress($accountId, true)['id']
            : session('new_offer')['address_id'];


        return view('offer/new-step-address', $data);
    }


    private function newOfferTransactionStep()
    {
        // --------------------------------------
        // Validate The Request
        // --------------------------------------
        if (!empty($this->request->getPost('transaction_method'))) {
            // updating offer session
            $transactionMethod = htmlspecialchars($this->request->getPost('transaction_method'));

            if (!in_array(strtolower($transactionMethod), ['online', 'offline'])) {
                set_alert('Metode transaksi tidak valid', true);
                return redirect()->to(base_url('offer/new'));
            }

            session()->push('new_offer', ['transaction_method' => $transactionMethod]);
            return redirect()->to(base_url('offer/new/3'));
        }

        // --------------------------------------
        // Go to view
        // --------------------------------------
        $address = $this->addressModel->find(session('new_offer')['address_id'], true);

        $data = [
            'title' => 'Buat Penawaran | TOKUKAS',
            'loginSession' => session('login'),
            'variable' => $this->variable,
            'pageDesc' => 'Pilih metode transaksi untuk penawaran buku anda',
            'step' => [
                'list' => $this->newOfferDefaultSteps,
                'current' => 1,
            ],
            'selectedTransactionMethod' => session('new_offer')['transaction_method'] ?? 'online',
            'canChoose' => strpos(strtoupper($address['stringified']), 'KABUPATEN INDRAMAYU'),
        ];

        return view('offer/new-step-transaction', $data);
    }


    private function newOfferShippingStep()
    {
        // --------------------------------------
        // Validate The Request
        // --------------------------------------
        if (!empty($this->request->getPost('expedition_id'))) {
            // updating offer session
            $transactionMethod = session('new_offer')['transaction_method'] ?? null;
            $expeditionId = htmlspecialchars($this->request->getPost('expedition_id'));

            if (empty($this->expeditionModel->find($expeditionId)) && $transactionMethod === 'online') {
                set_alert('Metode pengiriman tidak valid', true);
                return redirect()->to(base_url('offer/new/2'));
            }

            session()->push('new_offer', ['expedition_id' => $expeditionId]);
            return redirect()->to(base_url('offer/new/4'));
        }

        // --------------------------------------
        // Go to view
        // --------------------------------------
        $data = [
            'title' => 'Buat Penawaran | TOKUKAS',
            'loginSession' => session('login'),
            'variable' => $this->variable,
            'pageDesc' => 'Pilih metode pengiriman untuk penawaran buku anda',
            'step' => [
                'list' => $this->newOfferDefaultSteps,
                'current' => 2,
            ],
            'transactionMethod' => session('new_offer')['transaction_method'],
            'expeditions' => $this->expeditionModel->findAll(),
            'selectedExpedition' => session('new_offer')['expedition_id'] ?? null,
        ];

        return view('offer/new-step-expedition', $data);
    }


    private function newOfferPaymentStep()
    {
        // --------------------------------------
        // Validate The Request
        // --------------------------------------
        if (!empty($this->request->getPost())) {
            $paymentId = htmlspecialchars($this->request->getPost('payment_id'));
            $paymentType = $this->paymentMethod->validateType($paymentId);

            if (empty($paymentType)) {
                set_alert('Metode pembayaran tidak valid', true);
                return redirect()->to(base_url('offer/new/4'));
            }

            // set payment id session
            session()->push('new_offer', ['payment_id' => $paymentId]);

            // get payment destination (phone number / bank account number)
            return $this->getPaymentDestination($paymentType);
        }

        // --------------------------------------
        // Render Main View
        // --------------------------------------
        $data = [
            'title' => 'Buat Penawaran | TOKUKAS',
            'loginSession' => session('login'),
            'variable' => $this->variable,
            'pageDesc' => 'Pilih metode pembayaran untuk penawaran buku anda',
            'step' => [
                'list' => $this->newOfferDefaultSteps,
                'current' => 3,
            ],
            'paymentServices' => $this->paymentMethod->paymentService->findAll(),
            'banks' => $this->paymentMethod->bank->findAll(),
            'selectedPayment' => session('new_offer')['payment_id'] ?? null
        ];

        return view('offer/new-step-payment', $data);
    }


    private function getPaymentDestination(string $paymentType)
    {
        // Go to next step
        if ($paymentType === 'CASH') {
            return redirect()->to(base_url('offer/new/5'));
        }

        $data = [
            'title' => 'Buat Penawaran | TOKUKAS',
            'loginSession' => session('login'),
            'variable' => $this->variable,
            'pageDesc' => 'Pilih metode pembayaran untuk penawaran buku anda',
            'step' => [
                'list' => $this->newOfferDefaultSteps,
                'current' => 3,
            ],
            'paymentType' => $paymentType
        ];

        // Go to input payment destination
        if ($paymentType === 'PAYMENT_SERVICE') {
            $data['paymentMethod'] = $this->paymentMethod->paymentService;
        } else {
            $data['paymentMethod'] = $this->paymentMethod->bank;
        }

        return view('offer/new-step-payment-destination', $data);
    }


    private function newOfferBookStep()
    {
        return 'Upload data buku';
    }
}
