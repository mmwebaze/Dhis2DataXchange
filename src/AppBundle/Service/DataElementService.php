<?php

namespace AppBundle\Service;

use AppBundle\Util\Validator;
use AppBundle\Util\ArrayImploder;

/*require_once ('DataElementServiceInterface.php');
require_once ('util/Validator.php');
require_once ('util/ArrayImploder.php');*/

class DataElementService implements DataElementServiceInterface
{
    private $loginService;
    private $dataElementEndPoint = "dataElements";
    private $datasetEndPoint = "dataSets";
    private $baseURL;

    public function __construct($loginService, $baseURL)
    {
        $this->loginService = $loginService;
        $this->baseURL = $baseURL;
    }

    public function getDataElementByCode($code, $format="JSON")
    {
        $dataElementEndPoint = $this->baseURL.$this->dataElementEndPoint."/".$code.".".Validator::verifyFormat($format)."?fields=id,displayName";
        return $this->loginService->login($dataElementEndPoint);
    }

    public function getDataElements($isPaginated = TRUE, $format="JSON")
    {
        $dataElementEndPoint = $this->baseURL.$this->dataElementEndPoint.".".Validator::verifyFormat($format)."?fields=id,displayName&paging=".Validator::verifyPagination($isPaginated);
        return $this->loginService->login($dataElementEndPoint);
    }

    public function getDatasetDataElements($datasetCode, $isPaginated = TRUE, $format="JSON")
    {
        //$dataElementEndPoint = $this->baseURL."23/".$this->dataElementEndPoint."/".$datasetCode.".".Validator::verifyFormat($format)."?fields=dataSetElements[id,displayName]&paging=".Validator::verifyPagination($isPaginated);
        $dataElementEndPoint = $this->baseURL.$this->datasetEndPoint."/".$datasetCode.".".Validator::verifyFormat($format)."?fields=dataSetElements[dataElement[id,code,name]]&paging=".Validator::verifyPagination($isPaginated);
        return $this->loginService->login($dataElementEndPoint);
    }

    public function getDataElementValues($dataElementCodes = array(), $periods = array(), $orgUnits = array())
    {
        $analyticsConfig = '&tableLayout=true&columns=dx;ou&rows=pe&hideEmptyRows=true';
        $analytics = $this->baseURL.'analytics.json?dimension=dx:'. ArrayImploder::implodeArray($dataElementCodes) . '&dimension=pe:' .ArrayImploder::implodeArray($periods). '&dimension=ou:' .ArrayImploder::implodeArray($orgUnits).$analyticsConfig;
        echo $analytics;

        return $this->loginService->login($analytics);
    }
}