<?php

class OperationClaimDal{

    private $operationClaimObj;
    function __construct()
    {
        require_once("/wamp64/www/kds/Entities/operationClaim.php");
        require_once("/wamp64/www/kds/Business/Constants.php");
        // $this->operationClaimObj = new OperationClaim();
    }

    function GetAll(){
        require("/wamp64/www/kds/DataAccess/connection/connection.php");
        if ($kdsCon) {
            $query = mysqli_query($kdsCon, "SELECT * FROM operationClaim");
            if (mysqli_num_rows($query) > 0) {
                $claims = array();
                while($row = mysqli_fetch_assoc($query)){
                    $claims[] = $row;
                }
                mysqli_close($kdsCon);
                return $claims;
            }else{
                $claims = array();
                return $claims;
            }
        }else{
            return Constants::$connectionError;
        }
    }
}