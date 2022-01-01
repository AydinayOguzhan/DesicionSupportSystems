<?php
class PatientDal
{

    function __construct()
    {
        require_once("/wamp64/www/kds/Business/Constants.php");
    }

    function GetAllPatients()
    {
        require("/wamp64/www/kds/DataAccess/connection/connection.php");
        if ($kdsCon) {
            $query = mysqli_query($kdsCon, "select id, social_security_number, patient_first_name, patient_last_name, 
            FORMAT(TIMESTAMPDIFF(YEAR,patients.patient_date_of_birth,CURDATE()),0) as age from patients");
            if (mysqli_num_rows($query) > 0) {
                $users = array();
                while ($row = mysqli_fetch_assoc($query)) {
                    $users[] = $row;
                }
                mysqli_close($kdsCon);
                return $users;
            } else {
                $users = array();
                return $users;
            }
        } else {
            $users = array();
            return $users;
        }
    }

    function GetPatientById($patientId)
    {
        // require("/wamp64/www/kds/DataAccess/connection/connection.php");
        // if ($kdsCon) {
        //     $query = mysqli_query($kdsCon, "SELECT * from nurses WHERE id='" . $nurseId . "'");
        //     $this->userObj = mysqli_fetch_object($query);
        //     return $this->userObj;
        // } else {
        //     return $obj;
        // }
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
