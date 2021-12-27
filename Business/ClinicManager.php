<?php

class ClinicManager
{
    private $clinicDal;
    function __construct()
    {
        require_once("/wamp64/www/kds/Business/Constants.php");
        require_once("/wamp64/www/kds/DataAccess/ClinicDal.php");
        $this->clinicDal = new ClinicDal();
    }

    function GetAllClinics()
    {
        return $this->clinicDal->GetAllClinics();
    }

    function Add($clinicName)
    {
        $response = $this->clinicDal->Add($clinicName);
        if ($response == true) {
            return 1;
        } elseif ($response == Constants::$connectionError) {
            return Constants::$connectionError;
        } else {
            return Constants::$unsuccessful;
        }
    }

    function Delete($clinicId)
    {
        $response = $this->clinicDal->Delete($clinicId);
        if ($response == true) {
            return 1;
        } elseif ($response == Constants::$connectionError) {
            return Constants::$connectionError;
        } else {
            return Constants::$unsuccessful;
        }
    }

    function AddDoctorClinic($doctorId, $clinicId){
        $response = $this->clinicDal->AddDoctorClinic($doctorId, $clinicId);
        if ($response == true) {
            return 1;
        } elseif ($response == Constants::$connectionError) {
            throw new Exception(Constants::$connectionError, 1);
        } else {
            throw new Exception(Constants::$unsuccessful, 1);
        }
    }

    function DeleteDoctorClinic($doctorId){
        $response = $this->clinicDal->DeleteDoctorClinic($doctorId);
        if ($response == true) {
            return 1;
        } elseif ($response == Constants::$connectionError) {
            throw new Exception(Constants::$connectionError, 1);
        } else {
            throw new Exception(Constants::$unsuccessful, 1);
        }
    }

    function UpdateDoctorClinic($doctorId, $clinicId){
        $response = $this->clinicDal->UpdateDoctorClinic($doctorId,$clinicId);
        if ($response == true) {
            return 1;
        } elseif ($response == Constants::$connectionError) {
            throw new Exception(Constants::$connectionError, 1);
        } else {
            throw new Exception(Constants::$unsuccessful, 1);
        }
    }

    function GetClinicApplicationNumbers(){
        return $this->clinicDal->GetClinicApplicationNumbers();
    }

    function GetClinicPatientsAge(){
        return $this->clinicDal->GetClinicPatientsAge();
    }
}
