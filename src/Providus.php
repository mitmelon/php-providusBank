<?php
namespace Manomite;
use Curl\Curl;
use \Manomite\{
    Payment\Payment,
    Transfer\Transfer
};

class Providus
{
    public $transport;

    public function __construct(){
        $this->transport = new Curl();
    }

    public function payment($clientID, $clientSecret, $endpoint = 'https://vps.providusbank.com/vps/api/'){
        return (new Payment($clientID, $clientSecret, $endpoint));
    }

    public function transfer($username, $password, $endpoint = 'http://154.113.16.142:9999/Payments/api?wsdl'){
        return (new Transfer($username, $password, $endpoint));
    }

    protected function cleanResponse($response)
    {
        return json_decode(json_encode($response), true);
    }
}