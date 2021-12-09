<?php

$method = $_SERVER["REQUEST_METHOD"];
require_once "/wamp64/www/kds/Business/AuthManager.php";
require_once "/wamp64/www/kds/Entities/login.php";

switch ($method) {
    case 'POST':
        $authManager = new AuthManager();
        $loginObj = new Login();
        parse_str(file_get_contents("php://input"),$putVars);
        $loginObj->email = $putVars["email"];
        $loginObj->password = $putVars["password"];
        $authManager->Login($loginObj);
        break;
    case 'PUT':
        parse_str(file_get_contents("php://input"),$putVars);
        echo $putVars["email"];
        break;
    case 'DELETE':
        echo 3;
        break;
}
