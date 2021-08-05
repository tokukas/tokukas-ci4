<?php

namespace App\Libraries;

use Exception;

class CodeGenerator
{
    /**
     * The number of characters in id. If use_hex is true, the length must be an even number.
     *
     * @var int
     */
    protected $length;

    /**
     * Specific prefix to be assigned to the code (optional).
     *
     * @var string
     */
    protected $prefix;

    /**
     * Specific suffix to be assigned to the code (optional).
     *
     * @var string
     */
    protected $suffix;

    /**
     * The maximum length of code.
     *
     * Be aware of the length of the string that can be stored if you want to change this value.
     */
    protected $maxLength = 9999;


    public function __construct($length, $prefix = '', $suffix = '')
    {
        $this->length = $length;
        $this->prefix = $prefix;
        $this->suffix = $suffix;
    }


    /**
     * Generates a code consisting of several digits of a random hexadecimal number, plus a specified prefix or suffix.
     */
    public function getDecimalCode()
    {
        if ($this->length < 0 || $this->length > $this->maxLength) {
            throw new Exception('The value of \'length\' must be more than 0 and less than equal to ' . $this->maxLength);
        }

        $randNum = '';
        for ($i = $this->length; $i > 0; $i--) {
            $randNum .= random_int(0, 9);
        }

        return $this->prefix . $randNum . $this->suffix;
    }


    /**
     * Generates a code consisting of several digits of a random decimal number, plus a specified prefix or suffix.
     */
    public function getHexadecimalCode()
    {
        $binaryBase = 2;
        if ($this->length < 0 || $this->length > $this->maxLength) {
            throw new Exception('The value of \'length\' must be more than 0 and less than equal to ' . $this->maxLength);
        }

        if ($this->length % $binaryBase !== 0) {
            throw new Exception('\'length\' must be an even integer number');
        }

        $randHex = bin2hex(random_bytes($this->length / $binaryBase));
        return $this->prefix . $randHex . $this->suffix;
    }
}
