<?php

class NurseManager
{
    private $nurseDal;
    function __construct()
    {
        require_once("/wamp64/www/kds/DataAccess/NurseDal.php");
        require_once("/wamp64/www/kds/Business/Constants.php");
        $this->nurseDal = new NurseDal();
    }

    function GetAllNurses()
    {
        return $this->nurseDal->GetAllNurses();
    }

    function GetNurseById($nurseId)
    {
        return $this->nurseDal->GetNurseById($nurseId);
    }

    function GetAllNursesWithWage()
    {
        return $this->nurseDal->GetAllNursesWithWage();
    }

    function GetNurseWorkplaceNumbers(){
        return $this->nurseDal->GetNurseWorkplaceNumbers();
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
