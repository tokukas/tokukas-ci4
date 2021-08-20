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


    /**
     * Get all address that related with the account ID.
     * If $stringify is true, the address will be stringified from province, regency, district, village, street, and postal code value.
     */
    public function myAddress(string $accountId, $stringify = false)
    {
        $myAddresses = $this->where(['account_id' => $accountId])->findAll();

        if ($stringify) {
            $fullAddress = [];

            foreach ($myAddresses as $address) {
                array_push($fullAddress, [
                    'id' => $address['id'],
                    'account_id' => $address['account_id'],
                    'label' => $address['label'],
                    'is_default' => $address['is_default'],
                    'stringified' => $this->stringify($address),
                ]);
            }

            unset($myAddresses);
        }

        return $fullAddress ?? $myAddresses;
    }


    private function stringify($address)
    {
        $result = '';
        if (!empty($address)) {
            (!empty($address['street']))        && $result .= $address['street'];
            (!empty($address['village']))       && $result .= ', ' . $address['village'];
            (!empty($address['district']))      && $result .= ', ' . 'Kecamatan ' . $address['district'];
            (!empty($address['regency']))       && $result .= ', ' . ucwords(strtolower($address['regency']));
            (!empty($address['province']))      && $result .= ', ' . $address['province'];
            (!empty($address['postal_code']))   && $result .= ', ' . $address['postal_code'];
        }
        return $result;
    }


    /**
     * Checking if the label has been used by this account or not.
     */
    public function isLabelAlreadyUsed(string $accountId, string $label)
    {
        $myLabels = $this->where(['account_id' => $accountId])->findColumn('label');

        if (empty($myLabels)) {
            return false;
        }
        return in_array(ucwords($label), $myLabels);
    }
}
