<?php

class UserManager
{
    private $userDal;
    function __construct()
    {
        require_once("/wamp64/www/kds/DataAccess/UserDal.php");
        require_once("/wamp64/www/kds/Business/Constants.php");
        $this->userDal = new UserDal();
    }

    function GetAllUsers()
    {
        return $this->userDal->getAllUsers();
    }

    function GetUserById($userId)
    {
        return $this->userDal->GetUserById($userId);
    }

    function GetUserByEmail($email)
    {
        return $this->userDal->GetUserByEmail($email);
    }

    function Delete($userId)
    {
        $response = $this->userDal->Delete($userId);
        if ($response == true) {
            return Constants::$successful;
        } elseif ($response == Constants::$connectionError) {
            return Constants::$connectionError;
        } else {
            return Constants::$unsuccessful;
        }
    }

    function Add(User $user)
    {
        // $user->company_id = $user->company_id == 0 ? null : $user->company_id;
        $response = $this->userDal->Add($user);
        if ($response == true) {
            return 1;
        } elseif ($response == Constants::$connectionError) {
            return Constants::$connectionError;
        } else {
            return Constants::$unsuccessful;
        }
    }

    function Update(User $user)
    {
        $response = $this->userDal->Update($user);
        if ($response == true) {
            return 1;
        } elseif ($response == Constants::$connectionError) {
            return Constants::$connectionError;
        } else {
            return Constants::$unsuccessful;
        }
    }
}
