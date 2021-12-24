<?php
class DoctorDal
{
    private $majorManager;
    private $clinicManager;
    private $doctorWageManager;
    function __construct()
    {
        require_once("/wamp64/www/kds/Business/Constants.php");
        require_once("/wamp64/www/kds/Entities/doctor.php");
        require_once("/wamp64/www/kds/Business/MajorManager.php");
        require_once("/wamp64/www/kds/Business/ClinicManager.php");
        require_once("/wamp64/www/kds/Business/DoctorWageManager.php");
        $this->majorManager = new MajorManager();
        $this->clinicManager = new ClinicManager();
        $this->doctorWageManager = new DoctorWageManager();
    }

    function GetAllDoctors()
    {
        require("/wamp64/www/kds/DataAccess/connection/connection.php");
        if ($kdsCon) {
            $query = mysqli_query($kdsCon, "select doctors.id, doctors.doctor_first_name, doctors.doctor_last_name, 
            doctors.major_id, majors.major_name, clinics.id as clinic_id, clinics.clinic_name, doctorwages.wage 
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
            $query = mysqli_query($kdsCon, "select doctors.id, doctors.doctor_first_name, doctors.doctor_last_name, 
            doctors.major_id, majors.major_name, clinics.id as clinic_id, clinics.clinic_name, doctorwages.wage 
            from doctorworkplaces as dwp inner join doctors on dwp.doctor_id = doctors.id 
            inner join clinics on dwp.clinic_id = clinics.id 
            inner join doctorwages on dwp.doctor_id = doctorwages.doctor_id 
            inner join majors on majors.id = doctors.major_id where doctors.id= '".$doctorId."' ");
            $doctor = mysqli_fetch_object($query);
            return $doctor;
        } else {
            return $obj;
        }
    }


    function Delete($doctorId)
    {
        require("/wamp64/www/kds/DataAccess/connection/connection.php");
        if ($kdsCon) {
            try {
                $kdsCon->autocommit(false);
                $kdsCon->begin_transaction();
                
                $query = mysqli_query($kdsCon, "DELETE FROM `doctors` WHERE id='" . $doctorId . "'");

                $this->clinicManager->DeleteDoctorClinic($doctorId);
                $this->doctorWageManager->Delete($doctorId);

                $kdsCon->commit();
            } catch (\Throwable $th) {
                $kdsCon->rollback();
                throw new Exception(Constants::$unsuccessful, 1);
            }
        } else {
            return Constants::$connectionError;
        }
    }

    function Add(Doctor $doctor, $workplace, $wage)
    {
        require("/wamp64/www/kds/DataAccess/connection/connection.php");
        if ($kdsCon) {
            try {
                $kdsCon->autocommit(false);
                $kdsCon->begin_transaction();

                $query = mysqli_query($kdsCon, "INSERT INTO `doctors`(major_id, doctor_first_name, doctor_last_name) 
            values('" . $doctor->major_id . "','" . $doctor->first_name . "','" . $doctor->last_name . "')");

                $getNewDoctor = mysqli_query($kdsCon, "SELECT * from doctors where doctor_first_name ='" . $doctor->first_name . "'  
            and doctor_last_name = '" . $doctor->last_name . "' ");
                $newDoctor = mysqli_fetch_object($getNewDoctor);

                $this->clinicManager->AddDoctorClinic($newDoctor->id, $workplace);
                $this->doctorWageManager->Add($newDoctor->id, $wage);

                $kdsCon->commit();
                return $query;
            } catch (\Throwable $th) {
                $kdsCon->rollback();
                throw new Exception(Constants::$unsuccessful, 1);
            }
        } else {
            return Constants::$connectionError;
        }
    }

    function Update(Doctor $doctor, $workplace, $wage)
    {
        require("/wamp64/www/kds/DataAccess/connection/connection.php");
        if ($kdsCon) {
            try {
                $kdsCon->autocommit(false);
                $kdsCon->begin_transaction();

                $query = mysqli_query($kdsCon, "UPDATE doctors set major_id= '".$doctor->major_id."', 
                doctor_first_name = '".$doctor->first_name."', doctor_last_name= '".$doctor->last_name."' 
                where id= '".$doctor->id."' ");

                $this->clinicManager->UpdateDoctorClinic($doctor->id, $workplace);
                $this->doctorWageManager->Update($doctor->id, $wage);

                $kdsCon->commit();
                return 1;
            } catch (\Throwable $th) {
                $kdsCon->rollback();
                throw new Exception(Constants::$unsuccessful, 1);
            }
        } else {
            return Constants::$connectionError;
        }
    }
}
