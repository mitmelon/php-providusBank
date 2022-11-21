<?php

namespace Manomite\Payment;

class Payment extends \Manomite\Providus
{
    public function __construct($clientID, $clientSecret, $endpoint)
    {
        parent::__construct();
        $this->clientID = $clientID;
        $this->clientSecret = $clientSecret;
        $this->signature = hash('sha512', $this->clientID.':'.$this->clientSecret);
        $this->endpoint = $endpoint;
        $this->transport->setHeader('Content-Type', 'application/json');
        $this->transport->setHeader('X-Auth-Signature', $this->signature);
        $this->transport->setHeader('Client-Id', $this->clientID);
    }

    public function updateAccountName($account_name, $account_number)
    {
        $this->transport->post($this->endpoint.'PiPUpdateAccountName', [
            'account_name' => $account_name,
            'account_number' => $account_number
            ]);
        if ($this->transport->error) {
            return $this->transport->errorMessage;
        } else {
            return $this->cleanResponse($this->transport->response);
        }
    }

    public function createDynamicAccount($account_name)
    {
        $this->transport->post($this->endpoint.'PiPCreateDynamicAccountNumber', [
            'account_name' => $account_name
        ]);
        if ($this->transport->error) {
            return $this->transport->errorMessage;
        } else {
            return $this->cleanResponse($this->transport->response);
        }
    }

    public function createStaticAccount($account_name, $bvn = "")
    {
        $this->transport->post($this->endpoint.'PiPCreateReservedAccountNumber', [
            'account_name' => $account_name,
            'bvn' => $bvn
        ]);
        if ($this->transport->error) {
            return $this->transport->errorMessage;
        } else {
            return $this->cleanResponse($this->transport->response);
        }
    }

    public function blacklistAccount($account_number)
    {
        $this->transport->post($this->endpoint.'PiPBlacklistAccount', [
            'account_number' => $account_number
        ]);
        if ($this->transport->error) {
            return $this->transport->errorMessage;
        } else {
            return $this->cleanResponse($this->transport->response);
        }
    }

     public function verifyTransaction($sessionID)
     {
         $this->transport->get($this->endpoint.'PiPverifyTransaction?session_id='.$sessionID);
         if ($this->transport->error) {
             return $this->transport->errorMessage;
         } else {
             return $this->cleanResponse($this->transport->response);
         }
     }

     public function verifyTransactionBySession($sessionID)
     {
         $this->transport->get($this->endpoint.'PiPverifyTransaction_sessionid?session_id='.$sessionID);
         if ($this->transport->error) {
             return $this->transport->errorMessage;
         } else {
             return $this->cleanResponse($this->transport->response);
         }
     }

     public function verifyTransactionBySettlement($settleID)
     {
         $this->transport->get($this->endpoint.'PiPverifyTransaction_settlementid?settlement_id='.$settleID);
         if ($this->transport->error) {
             return $this->transport->errorMessage;
         } else {
             return $this->cleanResponse($this->transport->response);
         }
     }
}
