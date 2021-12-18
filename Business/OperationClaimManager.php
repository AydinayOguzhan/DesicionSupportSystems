<?php

class OperationClaimManager{

    private $operationClaimDal;
    function __construct()
    {
        require_once("/wamp64/www/kds/DataAccess/OperationClaimDal.php");
        require_once("/wamp64/www/kds/Business/Constants.php");
        $this->operationClaimDal = new OperationClaimDal();
    }

    function GetAll(){
        $response = $this->operationClaimDal->GetAll();
        // var_dump($response);
        return $response;
        // if (count($response) > 0) {
        //     return "çalıştı";
        // }else{
        //     return Constants::$connectionError;
        // }
    }
}