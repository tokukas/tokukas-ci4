<?php

namespace App\Models;

use App\Libraries\CodeGenerator;
use CodeIgniter\Model;
use Exception;

class MyModel extends Model
{
    /**
     * Will the primary key be generated automatically?
     *
     * @var boolean
     */
    protected $useAutoGenerateId = true;

    /**
     * Some id properties is required if $useAutoGenerateId is true.
     *
     * The properties of id are :
     *
     * length (int)[required] => The number of characters in id. If use_hex is true, the length must be an even number.
     *
     * use_hex (boolean)[optional] => If false, the id will be generated using decimal numbers.
     *
     * prefix (string)[optional] => Specific prefix to be assigned to the code.
     *
     * suffix (string)[optional] => Specific suffix to be assigned to the code.
     *
     * @var array
     */
    protected $idProperties = [];

    /**
     * Whether primary key uses auto increment.
     *
     * this property must be false, if $useAutoGenerateId is true.
     */
    protected $useAutoIncrement = false;


    protected function preparingAutoGenerate()
    {
        if ($this->autoGeneratePK === false) {
            throw new Exception('$useAutoGenerateId value must be true');
        }

        if ($this->useAutoIncrement !== false) {
            throw new Exception('$useAutoIncrement value must be false');
        }

        if (!in_array($this->primaryKey, $this->allowedFields)) {
            throw new Exception('The primary key field name must be added in allowedFields property');
        }

        if (empty($this->idProperties['length'])) {
            throw new Exception('The length id must be filled with a number greater than 0');
        }

        if ($this->idProperties['use_hex']) {
            if ($this->idProperties['length'] % 2 !== 0) {
                throw new Exception('The length id must be an even integer number, if use_hex value is true');
            }
        }
    }


    /**
     * Checks and gets an id for the primary key field of this table.
     * @return string A primary key id that can be used.
     * @throws Exception If there are no possible id left.
     */
    public function generateNewId()
    {
        // check auto generate id requirements
        $this->preparingAutoGenerate();

        $idLength = $this->idProperties['length'];
        $useHex = $this->idProperties['use_hex'] ?? false;
        $idPrefix = $this->idProperties['prefix'] ?? '';
        $idSuffix = $this->idProperties['suffix'] ?? '';

        $numBase = ($useHex) ? 16 : 10;
        $numOfCombinations = $numBase ** $idLength;

        $usedIds = [];
        $id = '';

        do {
            if (sizeof($usedIds) === $numOfCombinations) {
                throw new Exception('Failed to create new id. All possible id has been used.', 404);
            }

            // get random id
            $codeGen = new CodeGenerator($idLength, $idPrefix, $idSuffix);
            $id = ($useHex) ? $codeGen->getHexadecimalCode() : $codeGen->getDecimalCode();

            // check to used id list first
            $isIdExists = in_array($id, $usedIds);

            if ($isIdExists === false) {
                // try check to database
                $isIdExists = $this->find($id) !== null;

                // if random id is exists, add it to used id list
                $isIdExists && array_push($usedIds, $id);
            }
        } while ($isIdExists);

        return $id;
    }


    /**
     * A convenience method that will try to determine whether data
     * should be inserted or updated.
     *
     * To updated data, PK is needed. If in the data not contains PK,
     * data will be inserted with a generated PK.
     *
     * Will work with arrays or objects.
     *
     * @param array|object $data The data that will be inserted or updated.
     * @return string|boolean if inserting data success will return the id.
     * If data is updated will return boolean success or failed.
     */
    public function smartSave($data)
    {
        // updated data if in the data contains PK. If not, data will be inserted.
        if (!in_array($this->primaryKey, $data)) {
            $newId = $this->generateNewId();
            $data = array_merge([$this->primaryKey => $newId], $data);
        }

        // execute insert or update, then clear the data from temporary.
        $respons = $this->save($data);
        unset($data);

        return $newId ?? $respons;
    }


    public function list($field, $whereClause = [])
    {
        $records = $this->where($whereClause)->findAll();

        $result = [];
        foreach ($records as $record) {
            array_push($result, $record[$field]);
        }

        return $result;
    }


    public function listOrdered($by = 'id', $direction = 'asc', $whereClause = [])
    {
        return $this->builder()->orderBy($by, $direction)->where($whereClause)->get()->getResultArray();
    }


    public function isAlreadyExistIn($field, $value)
    {
        return $this->builder()->where($field, $value)->countAllResults() > 0;
    }
}
