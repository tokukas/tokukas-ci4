<?php

namespace App\Models;

use InvalidArgumentException;

class OfferModel extends MyModel
{
    protected $table = 'Offer';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false;
    protected $allowedFields = ['id', 'account_id', 'address_id', 'transaction_method', 'shipping_method', 'proposed_at'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $idProperties = [
        'length' => 16,
        'use_hex' => true
    ];


    public function isFilled(string $offerId, string|array $field)
    {
        $validFields = $this->allowedFields + ['payment_method'];
        $offer = $this->find($offerId);

        if (empty($offer)) {
            return false;
        }

        // checking value on allowed fields
        if (is_array($field) && !is_assoc_array($field)) {
            foreach ($field as $f) {
                if (!in_array($f, $validFields)) {
                    throw new InvalidArgumentException('Field \'' . $f . '\' is invalid');
                };

                if (empty($offer[$f])) {
                    return false;
                }
            }
            return true;
        }

        if (in_array($field, $validFields)) {
            return !empty($offer[$field]);
        }

        return false;
    }
}
