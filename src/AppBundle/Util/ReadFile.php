<?php
namespace AppBundle\Util;


class ReadFile
{
   /* public static function loadSecrets(){
        $loadSecrets = file_get_contents("secrets_remote.json");
        $secrets = json_decode($loadSecrets, true);

        return $secrets;
    }
    public static function loadPeriods(){
        $loadSecrets = file_get_contents("dhis2_periods.json");
        $secrets = json_decode($loadSecrets, true);

        return $secrets;
    }*/
    public static function loadJsonFile($jsonFile){
        $loadJson = file_get_contents($jsonFile);

        return json_decode($loadJson, true);
    }
}