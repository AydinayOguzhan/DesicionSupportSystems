<?php

$method = $_SERVER["REQUEST_METHOD"];
require_once("../kds/Business/AuthManager.php");
switch ($method) {
    case 'POST':
        
        // $authManager = new AuthManager();
        $authManager->Login($_SERVER["login"]);
        break;
    case 'PUT':
        echo 2;
        break;
    case 'DELETE':
        echo 3;
        break;
}
