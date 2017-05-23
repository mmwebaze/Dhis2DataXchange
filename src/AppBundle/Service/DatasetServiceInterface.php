<?php

namespace AppBundle\Service;


interface DatasetServiceInterface
{
    public function getDatasets($isPaginated, $format);
    public function getDatasetByCode($code, $format);
}