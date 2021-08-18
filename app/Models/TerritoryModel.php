<?php

namespace App\Models;

use CodeIgniter\Validation\Exceptions\ValidationException;

class TerritoryModel extends MyModel
{
    /*
     | ------------------------------------------------------
     | PROPERTIES
     | ------------------------------------------------------
    */

    /**
     * The scope.
     * @var string $scope
     */
    private $scope;

    /**
     * The list of scope in descending order of area level.
     */
    protected $scopes = ['provinces', 'regencies', 'districts', 'villages'];

    /**
     * The table name for each scope in descending order of area level.
     */
    protected $tableNames = [
        'provinces' => 'Reg_Provinces',
        'regencies' => 'Reg_Regencies',
        'districts' => 'Reg_Districts',
        'villages' => 'Reg_Villages'
    ];

    /**
     * The list of foreign key field name to upper area level in descending order of area level.
     */
    protected $foreignKeyFields = [
        'provinces' => null,
        'regencies' => 'province_id',
        'districts' => 'regency_id',
        'villages' => 'district_id'
    ];


    /*
     | ------------------------------------------------------
     | CONSTRUCTOR
     | ------------------------------------------------------
    */

    public function __construct($scope = '')
    {
        // validate the table name list with the scopes
        foreach ($this->tableNames as $tableScope => $tableName) {
            if (!in_array($tableScope, $this->scopes, true)) {
                throw new ValidationException('\'' . $tableScope . '\' is not found in scope list.');
            }
        }

        // validate the foreign key name list with the scopes
        foreach ($this->foreignKeyFields as $tableScope => $fkName) {
            if (!in_array($tableScope, $this->scopes, true)) {
                throw new ValidationException('\'' . $tableScope . '\' is not found in scope list.');
            }
        }

        // set the scope
        if (!empty($scope)) {
            $success = $this->setScope($scope);
            (!$success) && throw new ValidationException('Scope is failed to set because the value is empty or not valid.', API_BAD_REQUEST);
        }

        return $this;
    }

    /*
     | ------------------------------------------------------
     | REGULAR METHOD
     | ------------------------------------------------------
    */

    public function validateScope($scope)
    {
        return !empty($scope) && in_array($scope, $this->scopes);
    }


    public function setScope($scope)
    {
        $isValidScope = $this->validateScope($scope);
        ($isValidScope) && $this->scope = $scope;

        return $isValidScope;
    }


    public function getScope()
    {
        return $this->scope;
    }


    private function preparingScope()
    {
        if (empty($this->scope)) {
            throw new ValidationException("The scope property cannot empty.", API_BAD_REQUEST);
        }
    }


    public function getScopes()
    {
        return $this->scopes;
    }


    public function find($id = null)
    {
        $this->preparingScope();
        $tableName = $this->tableNames[$this->scope];

        return $this->builder($tableName)->getWhere(['id' => $id])->getFirstRow('array');
    }


    public function findAll(int $limit = 0, int $offset = 0)
    {
        $this->preparingScope();
        $tableName = $this->tableNames[$this->scope];

        return $this->builder($tableName)->get($limit, $offset)->getResultArray();
    }


    public function search(string $value, string $field, int $limit = 0, int $offset = 0)
    {
        $this->preparingScope();
        $tableName = $this->tableNames[$this->scope];

        return $this->builder($tableName)->like($field, $value)->get($limit, $offset)->getResultArray();
    }


    public function subareas(string $scopeId)
    {
        $this->preparingScope();

        // validate scope
        if ($this->scope === $this->scopes[sizeof($this->scopes) - 1]) {
            return [];
        }

        // get the scope target (the sub-area)
        $scopeTargetIndex = array_search($this->scope, $this->scopes) + 1;
        $scopeTarget = $this->scopes[$scopeTargetIndex];

        // get the destination table
        $tableName = $this->tableNames[$scopeTarget];
        $foreignFields = $this->foreignKeyFields[$scopeTarget];

        // find result from scope target table
        return $this->builder($tableName)->getWhere([$foreignFields => $scopeId])->getResultArray();
    }


    public function superareas(string $scopeId)
    {
        // validate scope
        if ($this->scope === $this->scopes[0]) {
            return null;
        }

        // validate this areas
        $currentAreas = $this->find($scopeId);

        if (empty($currentAreas)) {
            return null;
        }

        // get super-area id
        $foreignFields = $this->foreignKeyFields[$this->scope];
        $superareaId = $currentAreas[$foreignFields];


        // get the scope target (the super-area)
        $scopeTargetIndex = array_search($this->scope, $this->scopes) - 1;
        $scopeTarget = $this->scopes[$scopeTargetIndex];

        // get the destination table
        $tableName = $this->tableNames[$scopeTarget];


        // find result from scope target table
        return $this->builder($tableName)->getWhere(['id' => $superareaId])->getFirstRow('array');
    }
}
