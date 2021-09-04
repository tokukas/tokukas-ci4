<?php

namespace App\Models;

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
}
