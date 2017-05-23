<?php
namespace AppBundle\Service;

use AppBundle\Util\Validator;

/*require_once ('DatasetServiceInterface.php');
require_once ('util/Validator.php');*/

class DatasetService implements DatasetServiceInterface
{
    private $loginService;
    private $datasetEndPoint = "dataSets";
    private $baseURL;

    public function __construct($loginService, $baseURL)
    {
        $this->loginService = $loginService;
        $this->baseURL = $baseURL;
    }

    public function getDatasets($isPaginated=TRUE, $format="JSON")
    {
        $datasetEndPoint = $this->baseURL.$this->datasetEndPoint.".".Validator::verifyFormat($format)."?fields=id,displayName&paging=".Validator::verifyPagination($isPaginated);
        return $this->loginService->login($datasetEndPoint);
    }

    public function getDatasetByCode($code, $format="JSON")
    {
        $datasetEndPoint = $this->baseURL.$this->datasetEndPoint."/".$code.".".Validator::verifyFormat($format)."?fields=id,displayName";
        return $this->loginService->login($datasetEndPoint);
    }

}