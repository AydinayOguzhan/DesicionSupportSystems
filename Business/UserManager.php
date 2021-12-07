<?php 

    class UserManager{
        private $userDal;
        function __construct()
        {
            require_once("../DataAccess/UserDal.php");
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
    }
