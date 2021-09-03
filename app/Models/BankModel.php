<?php

namespace App\Models;

class BankModel extends MyModel
{
    protected $table = 'Bank';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false;
    protected $allowedFields = [];
    protected $useTimestamps = false;

    protected $idProperties = [
        'length' => 6,
        'use_hex' => true,
        'prefix' => 'BK'
    ];


    public function getLogos(string $id)
    {
        return $this->builder('Bank_Logo')->getWhere(['bank_id' => $id])
            ->getResultArray();
    }


    public function getLogosFileName(string $id)
    {
        $logos = $this->getLogos($id);
        return array_map(fn ($logo) => $logo['file_name'], $logos);
    }


    /**
     * Get one or more bank includes its logos.
     * @param array|integer|string|null $id One payment id or an array of payment ids.
     * @return array|null The resulting row of data, or null.
     */
    public function find($id = null)
    {
        $results = parent::find($id);

        if (empty($results)) {
            return $results;
        }

        // add bank's logos to results
        if (!is_assoc_array($results)) {
            foreach ($results as &$bank) {
                $bank += [
                    'logos' => $this->getLogosFileName($bank['id'])
                ];
            }
            unset($bank);    // !IMPORTANT to destroy this reference.
        } else {
            $results += [
                'logos' => $this->getLogosFileName($results['id'])
            ];
        }

        return $results;
    }


    public function findAll(int $limit = 0, int $offset = 0)
    {
        $banks = $this->builder()->orderBy('name', 'ASC')
            ->get($limit, $offset)->getResultArray();

        // add bank's logos to results
        return array_map(
            fn ($bank) => $bank += [
                'logos' => $this->getLogosFileName($bank['id'])
            ],
            $banks
        );
    }
}
