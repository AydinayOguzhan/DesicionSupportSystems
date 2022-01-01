<?php

class PatientManager
{
    private $patientDal;
    function __construct()
    {
        require_once("/wamp64/www/kds/DataAccess/PatientDal.php");
        require_once("/wamp64/www/kds/Business/Constants.php");
        $this->patientDal = new PatientDal();
    }

    function GetAllPatients()
    {
        return $this->patientDal->GetAllPatients();
    }

    function GetPatientById($patientId)
    {
        return $this->patientDal->GetPatientById($patientId);
    }

    function Delete()
    {
       
    }

    function Add()
    {
       
    }

    function Update()
    {
      
    }
}
