<?php

class DoctorWageManager
{
    private $doctorWageDal;
    function __construct()
    {
        require_once("/wamp64/www/kds/DataAccess/DoctorWageDal.php");
        require_once("/wamp64/www/kds/Business/Constants.php");
        $this->doctorWageDal = new DoctorWageDal();
    }

    function GetAllDoctorWages()
    {
        return $this->doctorWageDal->GetAllDoctorWages();
    }

    function GetDoctorWageById($doctorId)
    {
        return $this->doctorWageDal->GetDoctorWageById($doctorId);
    }

    function Delete($id)
    {
        $response = $this->doctorWageDal->Delete($id);
        if ($response == true) {
            return Constants::$successful;
        } elseif ($response == Constants::$connectionError) {
            throw new Exception(Constants::$connectionError, 1);
        } else {
            throw new Exception(Constants::$unsuccessful, 1);
        }
    }

    function Add($doctorId, $wage)
    {
        $wageDate = date_create()->format('Y-m-d H:i:s');
        $response = $this->doctorWageDal->Add($doctorId,$wage, $wageDate);
        if ($response == true) {
            return 1;
        } elseif ($response == Constants::$connectionError) {
            throw new Exception(Constants::$connectionError, 1);
        } else {
            throw new Exception(Constants::$unsuccessful, 1);
        }
    }

    function Update($doctorId, $wage)
    {
        $wageDate = date_create()->format('Y-m-d H:i:s');
        $response = $this->doctorWageDal->Update($doctorId, $wage,$wageDate);
        if ($response == true) {
            return 1;
        } elseif ($response == Constants::$connectionError) {
            throw new Exception(Constants::$connectionError, 1);
        } else {
            throw new Exception(Constants::$unsuccessful, 1);
        }
    }
}
