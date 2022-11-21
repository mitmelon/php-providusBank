<?php
namespace Manomite\Transfer;

class Transfer extends \Manomite\Providus
{
    private $username;
    private $password;
    private $endpoint;

    public function __construct($username, $password, $endpoint)
    {
        parent::__construct();
        $this->endpoint = $endpoint;
        $this->username = $username;
        $this->password = $password;
    }

    public function GetBVNDetails($bvn)
    {
        //This method takes a json string as an input and returns a json string response. It validates the supplied single BVN and returns the full demography details associated with the BVN.
        $this->transport->post($this->endpoint.'GetBVNDetails', [
            'bvn' => $bvn,
            'userName' => $this->username,
            'password' => $this->password
            ]);
        if ($this->transport->error) {
            return $this->transport->errorMessage;
        } else {
            return $this->cleanResponse($this->transport->response);
        }
    }

    public function GetNIPAccount($account_number, $bankCode)
    {
        /* This method takes a json string as an input and returns a json string response. It validates the
           supplied account number and 3-digit bank code and returns the account details. It can also accept
           the 6-digit NIP bank code in place of the 3-digit.
        */ 
        $this->transport->post($this->endpoint.'GetNIPAccount', [
            "accountNumber" => $account_number,
            "beneficiaryBank" => $bankCode, 
            'userName' => $this->username,
            'password' => $this->password
            ]);
        if ($this->transport->error) {
            return $this->transport->errorMessage;
        } else {
            return $this->cleanResponse($this->transport->response);
        }
    }

    public function NIPFundTransfer($ref, $b_account_name, $b_account_no, $b_bankCode, $amount, $currency, $narration, $source_account_name)
    {
        /* This method takes a json string as an input and returns a json string response. This method id used
           to transfer fund from a specified Providus account number to another account in a different bank.
           Parameters are compulsory. The transactionReference parameter must be unique for every
           transaction.
        */ 
        $this->transport->post($this->endpoint.'NIPFundTransfer', [
            "beneficiaryAccountName" => $b_account_name,
            "beneficiaryAccountNumber" => $b_account_no,
            "beneficiaryBank"=> $b_bankCode,
            "transactionAmount" => $amount,
            "currencyCode" => $currency,
            "narration" => $narration,
            "sourceAccountName"=> $source_account_name,
            "transactionReference"=> $ref, 
            'userName' => $this->username,
            'password' => $this->password
            ]);
        if ($this->transport->error) {
            return $this->transport->errorMessage;
        } else {
            return $this->cleanResponse($this->transport->response);
        }
    }

    public function GetNIPTransactionStatus($ref)
    {
        //This method takes a json string as an input and returns a json string response. It validates the supplied single transaction reference and returns the current status of the transaction. 
        $this->transport->post($this->endpoint.'GetNIPTransactionStatus', [
            "transactionReference" => $ref,
            'userName' => $this->username,
            'password' => $this->password
            ]);
        if ($this->transport->error) {
            return $this->transport->errorMessage;
        } else {
            return $this->cleanResponse($this->transport->response);
        }
    }

    public function GetNIPBanks()
    {
        // It returns the list of institutions currently enrolled on NIP and their respective NIP bank codes.
        $this->transport->get($this->endpoint.'GetNIPBanks');
        if ($this->transport->error) {
            return $this->transport->errorMessage;
        } else {
            return $this->cleanResponse($this->transport->response);
        }
    }

    public function ProvidusFundTransfer($ref, $c_account_no, $d_account_no, $amount, $currency, $narration)
    {
        //This method id used to transfer fund from a specified Providus account number to another ProvidusBank account
        $this->transport->post($this->endpoint.'ProvidusFundTransfer', [
            "creditAccount" => $c_account_no,
            "debitAccount"  => $d_account_no, 
            "transactionAmount" => $amount,
            "currencyCode" => $currency,
            "narration" => $narration,
            "transactionReference"=> $ref, 
            'userName' => $this->username,
            'password' => $this->password
            ]);
        if ($this->transport->error) {
            return $this->transport->errorMessage;
        } else {
            return $this->cleanResponse($this->transport->response);
        }
    }

    public function GetProvidusTransactionStatus($ref)
    {
        /* This method takes a json string as an input and returns a json string response. It validates the
           supplied single transaction reference and returns the current status of the transaction. This status is
           of Providus-to-Providus transactions. Note: It is advised to always do a status requery on all
           transaction regardless of the response gotten to know the final status of the transaction
           (Kindly extend status requery time to 15mins to be sure of final status).
        */
        $this->transport->post($this->endpoint.'/GetProvidusTransactionStatus', [
            "transactionReference"=> $ref, 
            'userName' => $this->username,
            'password' => $this->password
            ]);
        if ($this->transport->error) {
            return $this->transport->errorMessage;
        } else {
            return $this->cleanResponse($this->transport->response);
        }
    }

    public function GetProvidusAccount($account_no)
    {
        /* This method takes a json string as an input and returns a json string response Returns the details tied
           to your account including the balance. This account is the one tied to the username making the call. 
        */
        $this->transport->post($this->endpoint.'/GetProvidusAccount', [
            "accountNumber" => $account_no,
            'userName' => $this->username,
            'password' => $this->password
            ]);
        if ($this->transport->error) {
            return $this->transport->errorMessage;
        } else {
            return $this->cleanResponse($this->transport->response);
        }
    }
}
