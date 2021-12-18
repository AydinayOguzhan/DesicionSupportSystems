<?php

class UserOperationClaimDal{

    private $userOperationClaimObj;
    function __construct()
    {
        require_once("/wamp64/www/kds/Business/Constants.php");   
        require_once("/wamp64/www/kds/Entities/userOperationClaim.php");
        $userOperationClaimObj = new UserOperationClaim();
    }

    function Add(UserOperationClaim $userOperationClaim){
        require_once("/wamp64/www/kds/DataAccess/connection/connection.php");
        if ($kdsCon) {
            $query = mysqli_query($kdsCon,"INSERT INTO `useroperationclaim`(user_id, operation_claim_id) 
            values('".$userOperationClaim->userId."', '".$userOperationClaim->operationClaimId."')");
            return $query;
        }else{
            return Constants::$connectionError;
        }
    }

    function Update($userId, $operationClaimId){
        //TODO: Undefined variable kdscon. Çöz
        // require_once("/wamp64/www/kds/DataAccess/connection/connection.php");
        // if ($kdsCon) {
        //     $query = mysqli_query($kdsCon,"UPDATE useroperationclaim set operation_claim_id='".$operationClaimId."' 
        //     where user_id='".$userId."' ");
        //     return $query;
        // }else{
        //     return Constants::$connectionError;
        // }
    }

    function Delete(){
        require_once("/wamp64/www/kds/DataAccess/connection/connection.php");
        if ($kdsCon) {
            
        }else{
            return Constants::$connectionError;
        }
    }
}