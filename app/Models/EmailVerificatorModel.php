<?php

namespace App\Models;

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
    protected $minutesUntilCodeExpires = 30;

    /**
     * How many code requests can be sent to an email in a day (24 hours).
     * @var integer
     */
    protected $codeRequestLimitPerDay = 3;


    public function getMinutesUntilCodeExpires()
    {
        return $this->minutesUntilCodeExpires;
    }


    public function getEmail($id)
    {
        $verificator = $this->find($id);
        return (empty($verificator)) ? null : $verificator['email'];
    }


    public function isCodeExpired($id)
    {
        $verificator = $this->find($id);

        if (empty($verificator)) {
            return false;
        }

        // check validity period
        $now = Time::now();
        $codeExpirationTime = Time::parse($verificator['created_at'])->addMinutes($this->minutesUntilCodeExpires);

        return $now->isAfter($codeExpirationTime);
    }


    public function verifyCode($id, $code)
    {
        $verificator = $this->find($id);
        return (empty($verificator)) ? null : password_verify($code, $verificator['code']);
    }


    public function isVerified($id)
    {
        $verificator = $this->find($id);
        return (empty($verificator)) ? null : $verificator['verified'];
    }


    public function isRequestsReachesLimit($email)
    {
        $now = Time::now();
        $verificatorsDateCreated = $this->where(['email' => $email])->findColumn('created_at') ?: [];
        $HOURS_IN_ONE_DAY = 24;

        $countLimit = 0;
        foreach ($verificatorsDateCreated as $date) {
            $date = Time::parse($date);
            $timeDiff = $date->difference($now);

            $isToday = $timeDiff->getHours() < $HOURS_IN_ONE_DAY;
            ($isToday) && ++$countLimit;
        }


        return $countLimit >= $this->codeRequestLimitPerDay;
    }


    public function deleteWhere($whereClause)
    {
        $verificatorIds = $this->where($whereClause)->findColumn('id');
        return $this->delete($verificatorIds);
    }
}
