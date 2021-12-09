<?php 
    class UserDal{

        private $userObj;
        function __construct()
        {
            require_once("/wamp64/www/kds/Entities/user.php");
            require_once("/wamp64/www/kds/Business/Constants.php");
            $this->userObj = new User();
        }

        function GetAllUsers(){
            require("/wamp64/www/kds/DataAccess/connection/connection.php");
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
            require("/wamp64/www/kds/DataAccess/connection/connection.php");
            if ($kdsCon) {
                $query = mysqli_query($kdsCon, "SELECT * FROM users WHERE id=".$userId);
                $this->userObj = mysqli_fetch_object($query);
                return $userObj;
            }else{
                return $array;
            }
        }

        function GetUserByEmail($email){
            require("/wamp64/www/kds/DataAccess/connection/connection.php");
            if ($kdsCon) {
                $query = mysqli_query($kdsCon, "SELECT * FROM `users` WHERE email='".$email."'");
                if ($query == false) {
                    return Constants::$userNotFound;
                }else{
                    $this->userObj = mysqli_fetch_object($query);
                    return $this->userObj;
                }
            }else{
                return Constants::$connectionError;
            }
        }

        function Delete($userId){
            require("/wamp64/www/kds/DataAccess/connection/connection.php");
            if ($kdsCon) {
                $query = mysqli_query($kdsCon, "DELETE FROM 'users' WHERE id='".$userId."'");
                if ($query == false) {
                    return Constants::$unsuccessful;
                }else{
                    return Constants::$successful;
                }
            }else{
                return Constants::$connectionError;
            }
        }
    }
?>