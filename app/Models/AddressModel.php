<?php

namespace App\Models;

class AddressModel extends MyModel
{
    protected $table = 'Address';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false;
    protected $allowedFields = ['id', 'account_id', 'label', 'province', 'regency', 'district', 'village', 'postal_code', 'street', 'is_default'];

    protected $useTimestamps = false;

    protected $idProperties = [
        'length' => 18,
        'use_hex' => true
    ];


    public function myAddress($accountId)
    {
        return $this->where(['account_id' => $accountId])->findAll();
    }


    public function isLabelAlreadyUsed($accountId, $label)
    {
        $myLabels = $this->where(['account_id' => $accountId])->findColumn('label');

        if (empty($myLabels)) {
            return false;
        }
        return in_array(ucwords($label), $myLabels);
    }
}
