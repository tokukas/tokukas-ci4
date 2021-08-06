<?php

namespace App\Models;

use App\Libraries\CodeGenerator;
use CodeIgniter\I18n\Time;

class EmailVerificatorModel extends MyModel
{
    protected $table = 'Email_Verificator';
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

    /**
     * How long will the verification code expire. If set to 0, the verification code never can be used.
     * @var integer
     */
    protected $minutesUntilCodeExpires = 10;


    public function getMinutesUntilCodeExpires()
    {
        return $this->minutesUntilCodeExpires;
    }


    /**
     * Generates email verificator with random code.
     * @param string $email The user email address.
     * @return string|false Will return verificator id in string if success, or boolean false if failed.
     */
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
        $verificator = $this->find($id);

        // check validity period
        $now = Time::now();
        $codeExpirationTime = Time::parse($verificator['created_at'])->addMinutes($this->minutesUntilCodeExpires);

        return $now->isAfter($codeExpirationTime);
    }


    public function verifyCode($id, $code)
    {
        $verificator = $this->find($id);
        return $code === $verificator['code'];
    }
}
