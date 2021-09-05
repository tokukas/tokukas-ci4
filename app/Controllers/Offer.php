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

    private $newOfferSteps = [
        [
            'name' => 'Tentukan Lokasi Anda',
            'prerequisite' => []
        ],
        [
            'name' => 'Pilih Metode Transaksi',
            'prerequisite' => ['address_id']
        ],
        [
            'name' => 'Pilih Metode Pengiriman',
            'prerequisite' => ['address_id', 'transaction_method']
        ],
        [
            'name' => 'Pilih Metode Pembayaran',
            'prerequisite' => ['address_id', 'transaction_method', 'shipping_method']
        ],
        [
            'name' => 'Upload Data Buku',
            'prerequisite' => ['address_id']
        ]
    ];


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


    public function cancelNewOffer()
    {
        $this->offerModel->delete(session('new_offer'))
            && session()->remove('new_offer');
        return redirect()->to(base_url('offer'));
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

        // creating new offer
        if (!session()->has('new_offer')) {
            $accountId = $this->accountModel->getId(session('login')['email']);
            $offerId = $this->offerModel->smartSave(['account_id' => $accountId]);

            if (empty($offerId)) {
                set_alert('Penawaran baru gagal dibuat.', true);
                return redirect()->to(base_url('offer'));
            }

            session()->set('new_offer', $offerId);
            return redirect()->to(base_url('offer/new'));
        }

        /**
         * --------------------------------------
         * Form Routing
         * --------------------------------------
         */
        return $this->formRouting(session('new_offer'), $step);
    }


    private function formRouting(string $offerId, int $step)
    {
        $myOffer = $this->offerModel->find($offerId);

        // if offer id is invalid
        if (empty($myOffer)) {
            session()->remove('new_offer');
            set_alert('Sesi penawaran tidak valid.', true);
            return redirect()->to(base_url('offer'));
        }

        // if step is out of bond
        if ($step > sizeof($this->newOfferSteps)) {
            return redirect()->to(base_url('new/offer'));
        }

        $currentStep = $this->newOfferSteps[$step - 1];

        // check prerequisite
        if (!$this->offerModel->isFilled($offerId, $currentStep['prerequisite'])) {
            return redirect()->to(base_url('offer/new/' . $step - 1));
        }

        // saving offer if using POST request
        if (!empty($this->request->getPost())) {
            return $this->savingOffer($offerId, $step);
        }

        return $this->newOfferRenderView($myOffer, $step);
    }


    private function newOfferRenderView(array $offer, int $step)
    {
        $accountId = $this->accountModel->getId(session('login')['email']);

        $data = [
            'title' => 'Buat Penawaran | TOKUKAS',
            'loginSession' => session('login'),
            'variable' => $this->variable,
            'step' => [
                'list' => $this->newOfferSteps,
                'current' => $step - 1,
            ]
        ];

        // the other steps view
        if ($step === 2) {
            $address = $this->addressModel->find($offer['address_id'], true);

            $data['pageDesc'] = 'Pilih metode transaksi';
            $data['selectedTransactionMethod'] = $offer['transaction_method'] ?? 'online';
            $data['canChoose'] = strpos(strtoupper($address['stringified']), 'KABUPATEN INDRAMAYU');

            return view('offer/new-step-transaction', $data);
        }

        if ($step === 3) {
            # code...
        }

        // the first step
        $data['pageDesc'] = 'Masukkan alamat anda';
        $data['myAddresses'] = $this->addressModel->myAddresses($accountId, true);
        $data['selectedAddressId'] = $this->offerModel->isFilled($offer['id'], 'address_id')
            ? $offer['address_id']
            : $this->addressModel->getDefaultAddress($accountId, true)['id'];

        return view('offer/new-step-address', $data);
    }


    private function savingOffer(string $offerId, int $step)
    {
        $savingStatus = false;

        if ($step === 1 && !empty($this->request->getPost('address_id'))) {
            $addressId = htmlspecialchars($this->request->getPost('address_id'));

            // validate address id
            if (empty($this->addressModel->find($addressId, true))) {
                set_alert('Alamat tidak dapat ditemukan', true);
                return redirect()->back();
            }

            // saving address id
            $savingStatus = $this->offerModel->smartSave([
                'id' => $offerId,
                'address_id' => $addressId
            ]);

            (!$savingStatus) && set_alert('Alamat anda gagal disimpan', true);
        }

        if ($step === 2 && !empty($this->request->getPost('transaction_method'))) {
            $transactionMethod = htmlspecialchars($this->request->getPost('transaction_method'));

            // validate transaction method
            if (!in_array(strtolower($transactionMethod), ['online', 'offline'])) {
                set_alert('Metode transaksi tidak valid', true);
                return redirect()->back();
            }

            // saving transaction method
            $savingStatus = $this->offerModel->smartSave([
                'id' => $offerId,
                'transaction_method' => $transactionMethod
            ]);

            (!$savingStatus) && set_alert('Metode transaksi gagal disimpan', true);
        }

        // redirect
        return ($savingStatus)
            ? redirect()->to(base_url('offer/new/' . $step + 1))
            : redirect()->back();
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
        $offerId = session('new_offer');
        $offer = $this->offerModel->find($offerId);

        $data = [
            'title' => 'Buat Penawaran | TOKUKAS',
            'loginSession' => session('login'),
            'variable' => $this->variable,
            'pageDesc' => 'Pilih metode pengiriman untuk penawaran buku anda',
            'step' => [
                'list' => $this->newOfferSteps,
                'current' => 2,
            ],
            'transactionMethod' => $offer['transaction_method'],
            'expeditions' => $this->expeditionModel->findAll(),
            'selectedExpedition' => $offer['expedition_id'] ?? null,
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
                'list' => $this->newOfferSteps,
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
                'list' => $this->newOfferSteps,
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
