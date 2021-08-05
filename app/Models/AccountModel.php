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

    protected $validationRules = [
        'id' => 'required|is_unique[Account.id]|exact_length[16]',
        'email' => 'required|valid_email|is_unique[Account.email]|max_length[100]',
        'name' => 'required|max_length[255]',
        'password' => 'required',
    ];
    protected $validationMessages = [
        'id' => [
            'required' => 'ID akun wajib diisi.',
            'is_unique' => 'ID akun sudah digunakan.',
            'exact_length' => 'ID akun harus {param} karakter.',
        ],
        'email' => [
            'required' => 'Email wajib diisi.',
            'valid_email' => 'Harap masukkan email dengan benar',
            'is_unique' => 'Email ini sudah digunakan. Harap gunakan email lain',
            'max_length' => 'Email tidak boleh lebih dari {param} karakter.',
        ],
        'name' => [
            'required' => 'Nama wajib diisi',
            'max_length' => 'Nama tidak boleh lebih dari {param} karakter.',
        ],
        'password' => [
            'required' => 'Kata sandi wajib diisi',
        ],
    ];
    protected $skipValidation = false;


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
