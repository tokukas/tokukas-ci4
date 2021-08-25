<?php

namespace App\Models;

use CodeIgniter\Model;

class DBVariableModel extends Model
{
    protected $table = 'Variable';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = [];
    protected $useTimestamps = false;


    /**
     * @return string|null
     */
    public function getVar(string $name)
    {
        $var = $this->where('name', $name)->first();
        return (empty($var)) ? null : $var['value'];
    }
}
