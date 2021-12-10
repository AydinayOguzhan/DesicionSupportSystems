<?php 

    class UserManager{
        private $userDal;
        function __construct()
        {
            require_once("/wamp64/www/kds/DataAccess/UserDal.php");
            require_once("/wamp64/www/kds/Business/Constants.php");
            $this->userDal = new UserDal();
        }

        function GetAllUsers(){
            return $this->userDal->getAllUsers();
        }

        function GetUserById($userId){
            return $this->userDal->GetUserById($userId);
        }

        function GetUserByEmail($email){
            return $this->userDal->GetUserByEmail($email);
        }   

        function Delete($userId){
            $response = $this->userDal->Delete($userId);
            if ($response == true) {
                return Constants::$successful;
            }elseif($response == Constants::$connectionError){
                return Constants::$connectionError;
            }else{
                return Constants::$unsuccessful;
            }
        }
    }
