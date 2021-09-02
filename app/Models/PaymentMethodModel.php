<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentMethodModel extends MyModel
{
    protected $table = 'Payment_Method';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false;
    protected $allowedFields = [];
    protected $useTimestamps = false;

    protected $idProperties = [
        'length' => 8,
        'use_hex' => true
    ];


    public function getLogos(string $id)
    {
        return $this->builder('Payment_Logo')->getWhere(['payment_id' => $id])->getResultArray();
    }


    public function getLogosFileName(string $id)
    {
        $logos = $this->getLogos($id);
        return array_map(fn ($logo) => $logo['file_name'], $logos);
    }


    /**
     * Get one or more payment method includes its logos.
     * @param array|integer|string|null $id One payment id or an array of payment ids.
     * @return array|null The resulting row of data, or null.
     */
    public function find($id = null)
    {
        $results = parent::find($id);

        if (empty($results)) {
            return $results;
        }

        // add payment method's logos to results
        if (!is_assoc_array($results)) {
            foreach ($results as &$method) {
                $method += ['logos' => $this->getLogosFileName($method['id'])];
            }
            unset($method);    // !IMPORTANT to destroy this reference.
        } else {
            $results += ['logos' => $this->getLogosFileName($results['id'])];
        }

        return $results;
    }


    public function findAll(int $limit = 0, int $offset = 0, bool $onlineOnly = false)
    {
        $queryBuilder = $this->builder()->orderBy('name', 'ASC');
        ($onlineOnly) && $queryBuilder = $queryBuilder->where('dest_num_used !=', null);

        $paymentMethods = $queryBuilder->get($limit, $offset)->getResultArray();

        // add payment method's logos to results
        foreach ($paymentMethods as &$method) {
            $method += ['logos' => $this->getLogosFileName($method['id'])];
        }
        unset($method);    // !IMPORTANT to destroy this reference.
        return $paymentMethods;
    }
}
