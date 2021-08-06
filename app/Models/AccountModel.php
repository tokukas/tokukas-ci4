<?php

namespace App\Models;

class AccountModel extends MyModel
{
    protected $table = 'Account';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false;
    protected $allowedFields = ['id', 'email', 'name', 'password'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $idProperties = [
        'length' => 16,
        'use_hex' => true
    ];


    public function findByEmail($email)
    {
        return $this->where('email', $email)->first();
    }


    public function verify($email, $password)
    {
        $account = $this->findByEmail($email);
        $verified = false;

        if (isset($account)) {
            $verified = password_verify($password, $account['password']);
            unset($account);
        }

        return $verified;
    }
}
