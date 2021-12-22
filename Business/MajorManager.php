<?php

class MajorManager
{
    private $majorDal;
    function __construct()
    {
        require_once("/wamp64/www/kds/DataAccess/MajorDal.php");
        require_once("/wamp64/www/kds/Business/Constants.php");
        require_once("/wamp64/www/kds/Entities/major.php");
        $this->majorDal = new MajorDal();
    }

    function GetAllMajors()
    {
        return $this->majorDal->GetAllMajors();
    }

    function GetMajorById($majorId)
    {
        return $this->majorDal->GetMajorById($majorId);
    }


    function Delete($majorId)
    {
        $response = $this->majorDal->Delete($majorId);
        if ($response == true) {
            return Constants::$successful;
        } elseif ($response == Constants::$connectionError) {
            return Constants::$connectionError;
        } else {
            return Constants::$unsuccessful;
        }
    }

    function Add($majorName)
    {
        $response = $this->majorDal->Add($majorName);
        if ($response == true) {
            return 1;
        } elseif ($response == Constants::$connectionError) {
            return Constants::$connectionError;
        } else {
            return Constants::$unsuccessful;
        }
    }

    function Update(Major $major)
    {
        $response = $this->majorDal->Update($major);
        if ($response == true) {
            return 1;
        } elseif ($response == Constants::$connectionError) {
            return Constants::$connectionError;
        } else {
            return Constants::$unsuccessful;
        }
    }
}
