<?php

class DoctorManager
{
    private $doctorDal;
    function __construct()
    {
        require_once("/wamp64/www/kds/DataAccess/DoctorDal.php");
        require_once("/wamp64/www/kds/Business/Constants.php");
        require_once("/wamp64/www/kds/Entities/doctor.php");
        $this->doctorDal = new DoctorDal();
    }

    function GetAllDoctors()
    {
        return $this->doctorDal->GetAllDoctors();
    }

    function GetUserById($doctorId)
    {
        return $this->doctorDal->GetDoctorById($doctorId);
    }

    function GetAllDoctorsWithWage()
    {
        return $this->doctorDal->GetAllDoctorsWithWage();
    }

    function GetDoctorWorkplaceNumbers(){
        return $this->doctorDal->GetDoctorWorkplaceNumbers();
    }

    function Delete($doctorId)
    {
        $response = $this->doctorDal->Delete($doctorId);
        if ($response == true) {
            return Constants::$successful;
        } elseif ($response == Constants::$connectionError) {
            return Constants::$connectionError;
        } else {
            return Constants::$unsuccessful;
        }
    }

    function Add(Doctor $doctor, $workplace)
    {
        $response = $this->doctorDal->Add($doctor,$workplace);
        if ($response == true) {
            return 1;
        } elseif ($response == Constants::$connectionError) {
            return Constants::$connectionError;
        } else {
            return Constants::$unsuccessful;
        }
    }

    function Update()
    {
      
    }
}
