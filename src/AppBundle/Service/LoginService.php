<?php

namespace AppBundle\Service;

final class LoginService
{
    private $header = array();
    private $username;
    private $password;
    private $isSessionAlive = FALSE;

    private function __construct ($username, $password){
        $this->header = $this->setHeaders($username, $password);
        $this->username = $username;
        $this->password = $password;
    }
    public function login($url){
       $client = new \GuzzleHttp\Client();
      //$response = $client->request('GET', 'http://api.dhsprogram.com/rest/dhs/data');
      $response = $client->request('GET', $url,['auth' =>[$this->username,$this->password]]);

        return json_decode($response->getBody()->getContents(), true);
    }
    public static function instance($username, $password){

        static $inst = null;
        if ($inst === null){
            $inst = new LoginService($username, $password);
        }

        return $inst;
    }

    private function setHeaders($username, $password){
        $header = array();
        $header[] = 'Content-length: 0';
        $header[] = 'Content-type: application/json';
        return $header;
    }
    private function isSessionAlive(){

        return $this->isSessionAlive;
    }
}