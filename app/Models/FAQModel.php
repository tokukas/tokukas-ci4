<?php

namespace App\Models;

class FAQModel extends MyModel
{
    protected $table = 'FAQ';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false;
    protected $allowedFields = ['id', 'topic', 'question', 'answer'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $idProperties = [
        'length' => 20,
        'use_hex' => true
    ];


    public function list($topic = '', $limit = 0)
    {
        $queryBuilder = $this;

        (!empty($topic)) && $queryBuilder = $queryBuilder->where('topic', $topic);
        return $queryBuilder->orderBy('question', 'ASC')->findAll($limit) ?? [];
    }


    public function topics()
    {
        $uniqueTopics = [];

        foreach ($topics = $this->orderBy('topic', 'ASC')->findColumn('topic') as $topic) {
            if (!in_array($topic, $uniqueTopics)) {
                array_push($uniqueTopics, $topic);
            }
        }

        return $uniqueTopics;
    }
}
