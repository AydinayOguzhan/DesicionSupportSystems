<?php
class ClinicDal
{

    function __construct()
    {
        require_once("/wamp64/www/kds/Business/Constants.php");
    }

    function GetAllClinics()
    {
        require("/wamp64/www/kds/DataAccess/connection/connection.php");
        if ($kdsCon) {
            $query = mysqli_query($kdsCon, "SELECT * from clinics ");
            if (mysqli_num_rows($query) > 0) {
                $clinics = array();
                while ($row = mysqli_fetch_assoc($query)) {
                    $clinics[] = $row;
                }
                mysqli_close($kdsCon);
                return $clinics;
            } else {
                $clinics = array();
                return $clinics;
            }
        } else {
            $clinics = array();
            return $clinics;
        }
    }

    function Add($clinicName)
    {
        require("/wamp64/www/kds/DataAccess/connection/connection.php");
        if ($kdsCon) {       
            $query = mysqli_query($kdsCon, "INSERT INTO `clinics`(`clinic_name`) VALUES ('".$clinicName."')");
            return $query;
        } else {
            return Constants::$connectionError;
        }
    }

    function Delete($clinicId)
    {
        require("/wamp64/www/kds/DataAccess/connection/connection.php");
        if ($kdsCon) {       
            $query = mysqli_query($kdsCon, "DELETE FROM `clinics` WHERE id= '".$clinicId."' ");
            return $query;
        } else {
            return Constants::$connectionError;
        }
    }


    function AddDoctorClinic($doctorId, $clinicId){
        require("/wamp64/www/kds/DataAccess/connection/connection.php");
        if ($kdsCon) {       
            $query = mysqli_query($kdsCon, "INSERT INTO `doctorworkplaces`(`doctor_id`, `clinic_id`) 
            VALUES ('".$doctorId."' ,'".$clinicId."')");
            return $query;
        } else {
            return Constants::$connectionError;
        }
    }

    function DeleteDoctorClinic($doctorId){
        require("/wamp64/www/kds/DataAccess/connection/connection.php");
        if ($kdsCon) {       
            $query = mysqli_query($kdsCon, "DELETE FROM doctorworkplaces where doctor_id = '".$doctorId."' ");
            return $query;
        } else {
            return Constants::$connectionError;
        }
    }

    function UpdateDoctorClinic($doctorId, $clinicId){
        require("/wamp64/www/kds/DataAccess/connection/connection.php");
        if ($kdsCon) {       
            $query = mysqli_query($kdsCon, "UPDATE `doctorworkplaces` set clinic_id = '".$clinicId."'
            where doctor_id = '".$doctorId."' ");
            return $query;
        } else {
            return Constants::$connectionError;
        }
    }

    function GetClinicApplicationNumbers(){
        require("/wamp64/www/kds/DataAccess/connection/connection.php");
        if ($kdsCon) {
            $query = mysqli_query($kdsCon, "SELECT COUNT(applicationinformations.id) as application_numbers, clinics.clinic_name FROM `applicationinformations` 
            inner join clinics on applicationinformations.clinic_id = clinics.id GROUP by clinics.clinic_name");
            if (mysqli_num_rows($query) > 0) {
                $applicationNumbers = array();
                while ($row = mysqli_fetch_assoc($query)) {
                    $applicationNumbers[] = $row;
                }
                mysqli_close($kdsCon);
                return $applicationNumbers;
            } else {
                $applicationNumbers = array();
                return $applicationNumbers;
            }
        } else {
            $applicationNumbers = array();
            return $applicationNumbers;
        }
    }

    function GetClinicPatientsAge(){
        require("/wamp64/www/kds/DataAccess/connection/connection.php");
        if ($kdsCon) {
            $query = mysqli_query($kdsCon, "SELECT FORMAT(AVG(TIMESTAMPDIFF(YEAR,patients.patient_date_of_birth,CURDATE())),1) AS age
            FROM `patients` inner join applicationinformations on patients.id = applicationinformations.patient_id 
            inner join clinics on applicationinformations.clinic_id = clinics.id group by clinic_name");
            if (mysqli_num_rows($query) > 0) {
                $patientsAge = array();
                while ($row = mysqli_fetch_assoc($query)) {
                    $patientsAge[] = $row;
                }
                mysqli_close($kdsCon);
                return $patientsAge;
            } else {
                $patientsAge = array();
                return $patientsAge;
            }
        } else {
            $patientsAge = array();
            return $patientsAge;
        }
    }
}

