<?php
class MajorDal
{

    function __construct()
    {
        require_once("/wamp64/www/kds/Business/Constants.php");
        require_once("/wamp64/www/kds/Entities/major.php");
    }

    function GetAllMajors()
    {
        require("/wamp64/www/kds/DataAccess/connection/connection.php");
        if ($kdsCon) {
            $query = mysqli_query($kdsCon, "SELECT * from majors");
            if (mysqli_num_rows($query) > 0) {
                $majors = array();
                while ($row = mysqli_fetch_assoc($query)) {
                    $majors[] = $row;
                }
                mysqli_close($kdsCon);
                return $majors;
            } else {
                $majors = array();
                return $majors;
            }
        } else {
            $majors = array();
            return $majors;
        }
    }

   
    function GetMajorById($majorId)
    {
        require("/wamp64/www/kds/DataAccess/connection/connection.php");
        if ($kdsCon) {
            $query = mysqli_query($kdsCon, "SELECT * from majors WHERE id='" . $majorId . "'");
            $major = mysqli_fetch_object($query);
            return $major;
        } else {
            return $obj;
        }
    }

   
    function Delete($majorId)
    {
        require("/wamp64/www/kds/DataAccess/connection/connection.php");
        if ($kdsCon) {
            $query = mysqli_query($kdsCon, "DELETE FROM `majors` WHERE id='" . $majorId . "'");
            return $query;
        } else {
            return Constants::$connectionError;
        }
    }

    function Add($majorName)
    {
        require("/wamp64/www/kds/DataAccess/connection/connection.php");
        if ($kdsCon) {       
            $query = mysqli_query($kdsCon, "INSERT INTO `majors`(major_name) values('" . $majorName . "')");
            return $query;
        } else {
            return Constants::$connectionError;
        }
    }

    function Update(Major $major)
    {
        require("/wamp64/www/kds/DataAccess/connection/connection.php");
        if ($kdsCon) {
            $query = mysqli_query($kdsCon, "UPDATE majors SET  `major_name`='" . $major->majorName . "'
            WHERE id='" . $major->id . "' ");
            return $query;
        } else {
            return Constants::$connectionError;
        }
    }


}
