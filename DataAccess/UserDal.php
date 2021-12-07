<?php 
    class UserDal{

        private $userObj;
        function __construct()
        {
            require_once("../Entities/user.php");
            $this->userObj = new User();
        }

        function GetAllUsers(){
            require("../DataAccess/connection/connection.php");
            if ($kdsCon) {
                $query = mysqli_query($kdsCon, "SELECT * FROM users");
                if (mysqli_num_rows($query)) {
                    $users = array();
                    while($row=mysqli_fetch_assoc($query)){
                        $users[] = $row;
                    }
                    mysqli_close($kdsCon);
                    return $users;
                }else{
                    $users = array();
                    return $users;
                }
            }else{
                $users = array();
                return $users;
            }
        }


        function GetUserById($userId){
            require("../DataAccess/connection/connection.php");
            if ($kdsCon) {
                $query = mysqli_query($kdsCon, "SELECT * FROM users WHERE id=".$userId);
                $this->userObj = mysqli_fetch_object($query);
                return $userObj;
            }else{
                return $array;
            }
        }

        function GetUserByEmail($email){
            require("../DataAccess/connection/connection.php");
            if ($kdsCon) {
                $query = mysqli_query($kdsCon, "SELECT * FROM users WHERE email=".$email);
                $this->userObj = mysqli_fetch_object($query);
                return $userObj;
            }else{
                return $userObj;
            }
        }
    }
?>