<?php

namespace App\Models;

class PaymentMethodModel
{
    private $types = ['PAYMENT_SERVICE', 'BANK', 'CASH'];
    public $bank;
    public $paymentService;


    public function __construct()
    {
        $this->bank = new BankModel();
        $this->paymentService = new PaymentServiceModel();
    }


    public function find(string $id)
    {
        $paymentService = $this->paymentService->find($id);
        if (!empty($paymentService)) {
            return $paymentService;
        }

        $bank = $this->bank->find($id);
        if (!empty($bank)) {
            return $bank;
        }

        return null;
    }


    public function isPaymentService(string $id)
    {
        return !empty($this->paymentService->find($id));
    }


    public function isBank(string $id)
    {
        return !empty($this->bank->find($id));
    }


    public function validateType(string $id)
    {
        if ($this->isPaymentService($id)) {
            return $this->types[0];
        }

        if ($this->isBank($id)) {
            return $this->types[1];
        }

        if (strtoupper($id) === $this->types[2]) {
            return $this->types[2];
        }

        return null;
    }
}
