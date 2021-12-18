<?php 

class UserOperationClaimManager{

    private $userOperationClaimDal;
    private $userOperationClaimObj;
    function __construct()
    {
        require_once("/wamp64/www/kds/DataAccess/UserOperationClaimDal.php");
        require_once("/wamp64/www/kds/Entities/userOperationClaim.php");
        require_once("/wamp64/www/kds/Business/Constants.php");
        $this->userOperationClaimDal = new UserOperationClaimDal();
        $this->userOperationClaimObj = new UserOperationClaim();
    }

    function Add(UserOperationClaim $userOperationClaim){
        $response = $this->userOperationClaimDal->Add($userOperationClaim);
        if ($response === true) {
            return 1;
        }elseif($response == Constants::$connectionError){
            return $response;
        }else {
            return Constants::$unsuccessful;
        }
    }

    function Update($userId, $operationClaimId){
        $response = $this->userOperationClaimDal->Update($userId, $operationClaimId);
        if ($response === true) {
            return 1;
        }elseif($response == Constants::$connectionError){
            return $response;
        }else {
            return Constants::$unsuccessful;
        }
    }

    function Delete($userId){

    }
}