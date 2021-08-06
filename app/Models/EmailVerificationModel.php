<?php

namespace App\Models;

use App\Libraries\CodeGenerator;
use CodeIgniter\I18n\Time;

class EmailVerificationModel extends MyModel
{
    protected $table = 'Email_Verification';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false;
    protected $allowedFields = ['id', 'email', 'code', 'verified'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $idProperties = [
        'length' => 20,
        'use_hex' => true
    ];


    public function generateCode($email)
    {
        $codeGenerator = new CodeGenerator(6);
        $code = $codeGenerator->getDecimalCode();

        return $this->smartSave([
            'email' => $email,
            'code' => $code,
        ]);
    }


    public function getCode($id)
    {
        return $this->find($id)['code'];
    }


    public function isCodeExpired($id)
    {
        $minutesUntilCodeExpires = 30;
        $verificator = $this->find($id);

        // check validity period
        $now = Time::now();
        $codeExpirationTime = Time::parse($verificator['created_at'])->addMinutes($minutesUntilCodeExpires);

        return $now->isAfter($codeExpirationTime);
    }


    public function verifyCode($id, $code)
    {
        $verificator = $this->find($id);
        return $code === $verificator['code'];
    }
}
