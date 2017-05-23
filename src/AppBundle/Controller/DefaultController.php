<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Util\ReadFile;
use AppBundle\Service\LoginService;
use AppBundle\Service\OrgUnitService;

class DefaultController extends Controller
{
    /**
     * @Route("/home", name="homepage")
     */
    public function indexAction(Request $request)
    {
      /*$headers = array('Accept' => 'application/json');
      $query = array('q' => 'Frank sinatra', 'type' => 'track');
      $response = Unirest\Request::get('https://api.spotify.com/v1/search',$headers,$query);
      //dump($response->body);
      $encoders = array(new XmlEncoder(), new JsonEncoder());
      $normalizers = array(new ObjectNormalizer());

      $serializer = new Serializer($normalizers, $encoders);
      $serializer->serialize($response, 'json');
      die($serializer);*/
      $loginService = LoginService::instance('amza','district');
      $orgUnitService = new OrgUnitService($loginService, 'http://localhost:8181/dhis/api/');
      $data = $orgUnitService->getOrgUnits();
      dump($data);
      //$secrets = ReadFile::loadJsonFile("../../secrets_local.json");
      //dump($secrets);
      //$client = new \GuzzleHttp\Client();
//      $response = $client->request('GET', 'http://api.dhsprogram.com/rest/dhs/data');
      //$response = $client->request('GET', 'http://localhost:8181/dhis/api/resources.json',['auth' =>['amza','district']]);
      //$data = json_decode($response->getBody()->getContents(), true);


        // replace this example code with whatever you need
        return $this->render('home/home.html.twig', ['TotalPages' => $data['organisationUnits']]);
    }
}
