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


    private function stringify($address)
    {
        if (empty($address)) {
            return null;
        }

        $result['id'] = $address['id'];
        $result['account_id'] = $address['account_id'];
        $result['label'] = $address['label'];
        $result['is_default'] = $address['is_default'];

        // stringify the address
        $result['stringified'] = '';
        (!empty($address['street']))        && $result['stringified'] .= $address['street'];
        (!empty($address['village']))       && $result['stringified'] .= ', ' . $address['village'];
        (!empty($address['district']))      && $result['stringified'] .= ', ' . 'Kecamatan ' . $address['district'];
        (!empty($address['regency']))       && $result['stringified'] .= ', ' . ucwords(strtolower($address['regency']));
        (!empty($address['province']))      && $result['stringified'] .= ', ' . $address['province'];
        (!empty($address['postal_code']))   && $result['stringified'] .= ', ' . $address['postal_code'];

        return $result;
    }


    /**
     * Get all address that related with the account ID.
     * If $stringify is true, the address will be stringified from province, regency, district, village, street, and postal code value.
     */
    public function myAddresses(string $accountId, $stringify = false)
    {
        $myAddresses = $this->where(['account_id' => $accountId])->orderBy('label')->findAll() ?: [];

        if ($stringify) {
            $fullAddress = [];

            foreach ($myAddresses as $address) {
                array_push($fullAddress, $this->stringify($address));
            }

            unset($myAddresses, $newAddress);
        }

        return $fullAddress ?? $myAddresses;
    }


    /**
     * Count how many address from an account.
     */
    public function countMyAddress(string $accountId)
    {
        return $this->where(['account_id' => $accountId])->countAllResults();
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


    /**
     * Set an address to be the default address for an account.
     * @param string $addressId The ID of the address that will be the default address.
     * @return boolean True if success and false if failed.
     */
    public function setDefaultAddress(string $addressId)
    {
        $target = $this->find($addressId);
        $myAddressesId = $this->where(['account_id' => $target['account_id']])->findColumn('id');

        // set all of my addresses to non default
        foreach ($myAddressesId as $id) {
            if (!$this->smartSave(['id' => $id, 'is_default' => 0])) {
                return false;
            }
        }

        // set the target address to be default address
        unset($myAddressesId);
        return $this->smartSave(['id' => $target['id'], 'is_default' => 1]);
    }


    /**
     * Get an default address of an account
     */
    public function getDefaultAddress($accountId, $stringify = false)
    {
        $defaultAddress = $this->where(['account_id' => $accountId, 'is_default' => 1])->first();
        return ($stringify) ? $this->stringify($defaultAddress) : $defaultAddress;
    }


    /**
     * @return boolean
     */
    public function isDefaultAddress(string $addressId)
    {
        $address = $this->find($addressId);
        $isDefault = (empty($address)) ? false : $address['is_default'];
        unset($address);
        return $isDefault;
    }


    public function find($id = null, $stringify = false)
    {
        $address = $this->builder()->where('id', $id)->get()->getFirstRow('array');

        return ($stringify)
            ? $this->stringify($address)
            : $address;
    }
}
