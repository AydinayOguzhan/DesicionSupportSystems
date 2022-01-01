<?php

class PatientManager
{
    private $patientdal;
    function __construct()
    {
        require_once("/wamp64/www/kds/DataAccess/PatientDal.php");
        require_once("/wamp64/www/kds/Business/Constants.php");
        $this->patientdal = new PatientDal();
    }

    function GetAllPatients()
    {
        return $this->patientdal->GetAllPatients();
    }

    function GetPatientById($patientId)
    {
        return $this->patientdal->GetPatientById($patientId);
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
