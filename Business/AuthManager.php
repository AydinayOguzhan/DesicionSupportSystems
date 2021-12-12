<?php

class AuthManager
{
    private $userManager;
    private $loginObj;
    private $userObj;
    function __construct()
    {
        require_once("../Business/UserManager.php");
        require_once("../Entities/login.php");
        require_once("../Entities/user.php");
        require_once("../Business/Constants.php");
        $this->userManager = new UserManager();
        $this->loginObj = new Login();
        $this->userObj = new User();
    }

    public function Login(Login $login)
    {
        if ($login->email == "" || $login->password == "") {
            echo Constants::$dontLeaveBlank;
        } else {
            $this->userObj = $this->userManager->GetUserByEmail($login->email);
            if ($this->userObj == null) {
                echo Constants::$userNotFound;
            } elseif ($this->userObj == Constants::$connectionError) {
                echo Constants::$connectionError;
            } elseif ($login->email !== $this->userObj->email || $login->password !== $this->userObj->password) {
                echo Constants::$emailOrPasswordWrong;
            } else {
                session_start();
                $_SESSION["email"] = $this->userObj->email;
                $_SESSION["userId"] = $this->userObj->id;
                $_SESSION["operation_claim_id"] = $this->userObj->operation_claim_id;
                echo 1;
            }
        }
    }
}
