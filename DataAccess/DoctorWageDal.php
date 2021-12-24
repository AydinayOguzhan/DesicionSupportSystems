<?php
class DoctorWageDal
{

    function __construct()
    {
        require_once("/wamp64/www/kds/Business/Constants.php");
    }

    function GetAllDoctorWages()
    {
        require("/wamp64/www/kds/DataAccess/connection/connection.php");
        if ($kdsCon) {
            $query = mysqli_query($kdsCon, "SELECT * from doctorwages");
            if (mysqli_num_rows($query) > 0) {
                $doctorWages = array();
                while ($row = mysqli_fetch_assoc($query)) {
                    $doctorWages[] = $row;
                }
                mysqli_close($kdsCon);
                return $doctorWages;
            } else {
                $doctorWages = array();
                return $doctorWages;
            }
        } else {
            $doctorWages = array();
            return $doctorWages;
        }
    }


    function GetDoctorWageById($doctorId)
    {
        require("/wamp64/www/kds/DataAccess/connection/connection.php");
        if ($kdsCon) {
            $query = mysqli_query($kdsCon, "SELECT * from doctorwages WHERE doctor_id='" . $doctorId . "'");
            $doctorWage = mysqli_fetch_object($query);
            return $doctorWage;
        } else {
            return $obj;
        }
    }

   

    function Delete($id)
    {
        require("/wamp64/www/kds/DataAccess/connection/connection.php");
        if ($kdsCon) {
            $query = mysqli_query($kdsCon, "DELETE FROM `doctorwages` WHERE doctor_id='" . $id . "'");
            return $query;
        } else {
            return Constants::$connectionError;
        }
    }

    function Add($doctorId, $wage,$wageDate)
    {
        require("/wamp64/www/kds/DataAccess/connection/connection.php");
        if ($kdsCon) {       
            $query = mysqli_query($kdsCon, "INSERT INTO `doctorWages`(doctor_id,wage,wage_date) 
            values('" . $doctorId . "', '" . $wage . "','" . $wageDate . "')");
            return $query;
        } else {
            return Constants::$connectionError;
        }
    }

    function Update($doctorId, $wage, $wageDate)
    {
        require("/wamp64/www/kds/DataAccess/connection/connection.php");
        if ($kdsCon) {
            $query = mysqli_query($kdsCon, "UPDATE doctorwages SET  wage ='".$wage."', 
            wage_date='".$wageDate."' WHERE doctor_id='" . $doctorId . "' ");
            return $query;
        } else {
            return Constants::$connectionError;
        }
    }


}
