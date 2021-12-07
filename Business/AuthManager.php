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
        $this->userManager = new UserManager();
        $this->loginObj = new Login();
        $this->userObj = new User();
    }

    public function Login(Login $login){
        $this->userObj = $this->userManager->GetUserByEmail($login->email);

        echo $login->email;

        // if ($login->email == "" || $login->password == "") {
        //     echo 0;
        // }elseif ($login->email !== $this->userObj->email || $login->password !== $this->userObj->password) {
        //     echo 1;
        // }else{
        //     echo 2;
        // }
    }
}

?>