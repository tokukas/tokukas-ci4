<?php

namespace App\Models;

class PaymentServiceModel extends MyModel
{
    protected $table = 'Payment_Service';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false;
    protected $allowedFields = [];
    protected $useTimestamps = false;

    protected $idProperties = [
        'length' => 6,
        'use_hex' => true,
        'prefix' => 'PY'
    ];


    public function getLogos(string $id)
    {
        return $this->builder('Payment_Logo')->getWhere(['payment_service_id' => $id])
            ->getResultArray();
    }


    public function getLogosFileName(string $id)
    {
        $logos = $this->getLogos($id);
        return array_map(fn ($logo) => $logo['file_name'], $logos);
    }


    /**
     * Get one or more payment service includes its logos.
     * @param array|integer|string|null $id One payment id or an array of payment ids.
     * @return array|null The resulting row of data, or null.
     */
    public function find($id = null)
    {
        $results = parent::find($id);

        if (empty($results)) {
            return $results;
        }

        // add payment service's logos to results
        if (!is_assoc_array($results)) {
            foreach ($results as &$service) {
                $service += [
                    'logos' => $this->getLogosFileName($service['id'])
                ];
            }
            unset($service);    // !IMPORTANT to destroy this reference.
        } else {
            $results += [
                'logos' => $this->getLogosFileName($results['id'])
            ];
        }

        return $results;
    }


    public function findAll(int $limit = 0, int $offset = 0)
    {
        $paymentServices = $this->builder()->orderBy('name', 'ASC')
            ->get($limit, $offset)->getResultArray();

        // add payment service's logos to results
        return array_map(
            fn ($service) => $service += [
                'logos' => $this->getLogosFileName($service['id'])
            ],
            $paymentServices
        );
    }


    public function supportedBanks(string $id)
    {
        return $this->builder('Payment_Service_Bank_Transfer')
            ->getWhere('payment_service_id', $id)->getResultArray();
    }


    public function isSupportBankTransfer(string $id)
    {
        return $this->builder('Payment_Service_Bank_Transfer')
            ->where('payment_service_id', $id)->countAllResults() > 0;
    }


    public function isUsePhoneNumber(string $id)
    {
        $service = $this->builder()->where([
            'id' => $id,
            'use_phone_number' => true
        ])->get()->getFirstRow();

        return !empty($service);
    }
}
