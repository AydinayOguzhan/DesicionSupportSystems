<?php
class NurseDal
{

    function __construct()
    {
        require_once("/wamp64/www/kds/Business/Constants.php");
    }

    function GetAllNurses()
    {
        require("/wamp64/www/kds/DataAccess/connection/connection.php");
        if ($kdsCon) {
            $query = mysqli_query($kdsCon, "SELECT * from nurses");
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

    function GetAllNursesWithWage()
    {
        require("/wamp64/www/kds/DataAccess/connection/connection.php");
        if ($kdsCon) {
            $query = mysqli_query($kdsCon, "select nurses.id, nurses.nurse_first_name, nurses.nurse_last_name, nursewages.wage 
            from nurses inner join nursewages ON nurses.id = nursewages.nurse_id");
            if (mysqli_num_rows($query) > 0) {
                $nurse = array();
                while ($row = mysqli_fetch_assoc($query)) {
                    $nurse[] = $row;
                }
                mysqli_close($kdsCon);
                return $nurse;
            } else {
                $nurse = array();
                return $nurse;
            }
        } else {
            $nurse = array();
            return $nurse;
        }
    }

    function GetNurseWorkplaceNumbers()
    {
        require("/wamp64/www/kds/DataAccess/connection/connection.php");
        if ($kdsCon) {
            $query = mysqli_query($kdsCon, "select nwp.id, nwp.clinic_id, clinics.clinic_name, nwp.clinic_id,COUNT(nwp.clinic_id) 
            from nurseworkplaces as nwp inner join clinics on nwp.clinic_id = clinics.id 
            GROUP BY nwp.clinic_id HAVING COUNT(nwp.clinic_id) >= 1");
            if (mysqli_num_rows($query) > 0) {
                $nurse = array();
                while ($row = mysqli_fetch_assoc($query)) {
                    $nurse[] = $row;
                }
                mysqli_close($kdsCon);
                return $nurse;
            } else {
                $nurse = array();
                return $nurse;
            }
        } else {
            $nurse = array();
            return $nurse;
        }
    }

    function GetNurseById($nurseId)
    {
        require("/wamp64/www/kds/DataAccess/connection/connection.php");
        if ($kdsCon) {
            $query = mysqli_query($kdsCon, "SELECT * from nurses WHERE id='" . $nurseId . "'");
            $this->userObj = mysqli_fetch_object($query);
            return $this->userObj;
        } else {
            return $obj;
        }
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
