<?php
class DoctorDal
{
    function __construct()
    {
        require_once("/wamp64/www/kds/Business/Constants.php");
        require_once("/wamp64/www/kds/Entities/doctor.php");
    }

    function GetAllDoctors()
    {
        require("/wamp64/www/kds/DataAccess/connection/connection.php");
        if ($kdsCon) {
            $query = mysqli_query($kdsCon, "select doctors.id, doctors.doctor_first_name, doctors.doctor_last_name, 
            doctors.major_id, majors.major_name, clinics.id, clinics.clinic_name, doctorwages.wage 
            from doctorworkplaces as dwp inner join doctors on dwp.doctor_id = doctors.id 
            inner join clinics on dwp.clinic_id = clinics.id 
            inner join doctorwages on dwp.doctor_id = doctorwages.doctor_id 
            inner join majors on majors.id = doctors.major_id");
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

    function GetAllDoctorsWithWage()
    {
        require("/wamp64/www/kds/DataAccess/connection/connection.php");
        if ($kdsCon) {
            $query = mysqli_query($kdsCon, "select doctors.id, doctors.doctor_first_name, doctors.doctor_last_name, doctorwages.wage, 
            doctorwages.wage_date from doctors inner join doctorwages on doctors.id = doctorwages.doctor_id");
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

    function GetDoctorWorkplaceNumbers()
    {
        require("/wamp64/www/kds/DataAccess/connection/connection.php");
        if ($kdsCon) {
            $query = mysqli_query($kdsCon, "select dwp.id, dwp.clinic_id, clinics.clinic_name, dwp.clinic_id,COUNT(dwp.clinic_id) 
            from doctorworkplaces as dwp inner join clinics on dwp.clinic_id = clinics.id 
            GROUP BY dwp.clinic_id HAVING COUNT(dwp.clinic_id) > 0");
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

    function GetDoctorById($doctorId)
    {
        require("/wamp64/www/kds/DataAccess/connection/connection.php");
        if ($kdsCon) {
            $query = mysqli_query($kdsCon, "SELECT * from doctors WHERE id='" . $doctorId . "'");
            $this->userObj = mysqli_fetch_object($query);
            return $this->userObj;
        } else {
            return $obj;
        }
    }

   

    function Delete($doctorId)
    {
        require("/wamp64/www/kds/DataAccess/connection/connection.php");
        if ($kdsCon) {
            $query = mysqli_query($kdsCon, "DELETE FROM `doctors` WHERE id='" . $doctorId . "'");
            $query2 = mysqli_query($kdsCon, "DELETE FROM `doctorworkplaces` WHERE doctor_id='" . $doctorId . "'");
            return $query;
        } else {
            return Constants::$connectionError;
        }
    }

    function Add(Doctor $doctor, $workplace)
    {
        require("/wamp64/www/kds/DataAccess/connection/connection.php");
        if ($kdsCon) {       
            $query = mysqli_query($kdsCon, "INSERT INTO `doctors`(major_id, doctor_first_name, doctor_last_name) 
            values('" . $doctor->major_id . "','" . $doctor->first_name . "','" . $doctor->last_name . "')");

            $getNewDoctor = mysqli_query($kdsCon, "SELECT * from doctors where doctor_first_name ='".$doctor->first_name."'  
            and doctor_last_name = '".$doctor->last_name."' ");
            $newDoctor = mysqli_fetch_object($getNewDoctor);

            $addWorkplace = mysqli_query($kdsCon,"INSERT INTO `doctorworkplaces`(`doctor_id`, `clinic_id`) 
            VALUES ('".$newDoctor->id."' ,'".$workplace."')");

            return $query;
        } else {
            return Constants::$connectionError;
        }
    }

    function Update()
    {
       
    }

}
