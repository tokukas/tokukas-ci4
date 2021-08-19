<?php

namespace App\Controllers;

use App\Models\TerritoryModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class IdnTerritory extends ResourceController
{
    use ResponseTrait;

    protected $territoryModel;


    public function __construct()
    {
        $this->territoryModel = new TerritoryModel();
    }


    public function index()
    {
        $firstScope = $this->territoryModel->getScopes()[0];
        return $this->list($firstScope);
    }


    protected function successResponse($result, $statusCode)
    {
        $data['status'] = $statusCode;
        $data['error'] = false;
        $data['result'] = $result;

        return $this->respond($data);
    }


    protected function failResponse($statusCode, $message)
    {
        $data['status'] = $statusCode;
        $data['error'] = true;
        $data['message'] = $message;

        return $this->respond($data);
    }


    public function get($scope, $id)
    {
        if (!$this->territoryModel->setScope($scope)) {
            return $this->failResponse(API_BAD_REQUEST, "The '$scope' is invalid scope value.");
        }

        $result = $this->territoryModel->find($id);

        return ($result)
            ? $this->successResponse($result, API_OK)
            : $this->failResponse(API_NOT_FOUND, "There are no $scope match with this ID.");
    }


    public function list($scope, $page = 1, $rowLimit = 0)
    {
        if (!$this->territoryModel->setScope($scope)) {
            return $this->failResponse(API_BAD_REQUEST, "The '$scope' is invalid scope value.");
        }

        $limit = $rowLimit ?: 5000;
        $result = $this->territoryModel->findAll($limit, ($page - 1) * $limit);

        return ($result)
            ? $this->successResponse($result, API_OK)
            : $this->failResponse(API_NOT_FOUND, "There are no $scope found.");
    }


    public function searchByName($scope, $name, $page = 1)
    {
        if (!$this->territoryModel->setScope($scope)) {
            return $this->failResponse(API_BAD_REQUEST, "The '$scope' is invalid scope value.");
        }

        if (empty($name) || strlen($name) < 3) {
            return $this->failResponse(API_BAD_REQUEST, "The search name cannot empty. Need atleast 3 character.");
        }

        $limit = 5000;
        $result = $this->territoryModel->search($name, 'name', $limit, ($page - 1) * $limit);

        return ($result)
            ? $this->successResponse($result, API_OK)
            : $this->failResponse(API_NOT_FOUND, "There are no $scope found with this name.");
    }


    public function subareas($scope, $id)
    {
        if (!$this->territoryModel->setScope($scope)) {
            return $this->failResponse(API_BAD_REQUEST, "The '$scope' is invalid scope value.");
        }

        $result = $this->territoryModel->subareas($id);

        return ($result)
            ? $this->successResponse($result, API_OK)
            : $this->failResponse(API_NOT_FOUND, "There are no sub-areas found in this $scope.");
    }


    public function superareas($scope, $id)
    {
        if (!$this->territoryModel->setScope($scope)) {
            return $this->failResponse(API_BAD_REQUEST, "The '$scope' is invalid scope value.");
        }

        $result = $this->territoryModel->superareas($id);

        return ($result)
            ? $this->successResponse($result, API_OK)
            : $this->failResponse(API_NOT_FOUND, "There are no super-areas found of this $scope.");
    }
}
