<?php 
    require_once("/wamp64/www/kds/Business/UserManager.php");
    $method = $_SERVER["REQUEST_METHOD"];
    
    switch ($method) {
        case 'POST':
            echo 1;
            break;
        case 'PUT': 
            echo 2;
            break;
        case 'DELETE':
            $userManager = new UserManager();
            parse_str(file_get_contents("php://input"),$putVars);
            $userId = $putVars["userId"];
            echo $userManager->Delete($userId);
            break;
    }
?>