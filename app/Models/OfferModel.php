<?php

namespace App\Models;

use CodeIgniter\Model;

class OfferModel extends MyModel
{
    protected $table = 'Offer';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false;
    protected $allowedFields = ['id', 'account_id', 'address', 'transaction_method', 'payment_used', 'shipping_used'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $idProperties = [
        'length' => 16,
        'use_hex' => true
    ];
}
