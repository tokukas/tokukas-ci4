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


    /**
     * Get an account data (except the password) by its email.
     * @param string $email The email.
     * @return mixed|null An account data.
     */
    public function findByEmail($email)
    {
        $account = $this->where('email', $email)->first();

        if (!empty($account)) {
            unset($account['password']);
        }

        return $account;
    }


    /**
     * Get an account ID by its email.
     * @param string $email The email.
     * @return string The account ID.
     */
    public function getId($email)
    {
        $account = $this->where('email', $email)->first();

        $id = (empty($account)) ? '' : $account['id'];
        unset($account);

        return $id;
    }


    public function verify($email, $password)
    {
        $account = $this->where('email', $email)->first();

        $verified = (empty($account)) ? false : password_verify($password, $account['password']);
        unset($account);

        return $verified;
    }
}
