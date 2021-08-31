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
        return $this->builder('Expedition_Logo')->getWhere(['expedition_id' => $expeditionId])->getResultArray() ?: [];
    }


    public function getLogosFileName(string $expeditionId)
    {
        $logos = $this->getLogos($expeditionId) ?: [];
        $logoNameList = [];

        foreach ($logos as $logo) {
            if (!empty($logo)) {
                array_push($logoNameList, $logo['file_name']);
            }
        }

        return $logoNameList;
    }


    public function find($id = null)
    {
        $expedition = $this->builder()->getWhere(['id' => $id])->getFirstRow('array') ?: [];

        if (!empty($expedition)) {
            $expedition = array_merge($expedition, ['logos' => $this->getLogosFileName($id)]);
        }

        return $expedition;
    }


    public function findAll(int $limit = 0, int $offset = 0)
    {
        $res = [];
        $expeditions = $this->builder()->orderBy('name', 'ASC')->get($limit, $offset)->getResultArray() ?: [];

        foreach ($expeditions as $expedition) {
            $expedition = array_merge($expedition, [
                'logos' => $this->getLogosFileName($expedition['id'])
            ]);

            array_push($res, $expedition);
        }

        return $res;
    }
}
