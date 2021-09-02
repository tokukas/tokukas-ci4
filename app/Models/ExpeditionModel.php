<?php

namespace App\Models;

class ExpeditionModel extends MyModel
{
    protected $table = 'Expedition';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false;
    protected $allowedFields = [];
    protected $useTimestamps = false;
    protected $idProperties = [
        'length' => 8,
        'use_hex' => true
    ];


    public function getLogos(string $expeditionId)
    {
        return $this->builder('Expedition_Logo')->getWhere(['expedition_id' => $expeditionId])->getResultArray();
    }


    public function getLogosFileName(string $expeditionId)
    {
        $logos = $this->getLogos($expeditionId);
        return array_map(fn ($logo) => $logo['file_name'], $logos);
    }


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


    public function findAll(int $limit = 0, int $offset = 0)
    {
        $expeditions = $this->builder()->orderBy('name', 'ASC')->get($limit, $offset)->getResultArray();

        foreach ($expeditions as &$expedition) {
            $expedition += ['logos' => $this->getLogosFileName($expedition['id'])];
        }
        unset($expedition);    // !IMPORTANT to destroy this reference.
        return $expeditions;
    }
}
