<?php 
    require_once("/wamp64/www/kds/Business/UserManager.php");
    require_once("/wamp64/www/kds/Entities/user.php");
    $method = $_SERVER["REQUEST_METHOD"];
    
    switch ($method) {
        case 'POST':
            $userManager = new UserManager();
            $userObj = new User();
            parse_str(file_get_contents("php://input"),$putVars);
            $userObj->company_id = $putVars["company_id"];
            $userObj->first_name = $putVars["first_name"];
            $userObj->last_name = $putVars["last_name"];
            $userObj->email = $putVars["email"];
            $userObj->password = $putVars["password"];
            echo $userManager->Add($userObj);
            break;
        case 'PUT': 
            $userManager = new UserManager();
            $userObj = new User();
            parse_str(file_get_contents("php://input"),$putVars);
            $userObj->id = $putVars["id"];
            $userObj->company_id = $putVars["company_id"];
            $userObj->first_name = $putVars["first_name"];
            $userObj->last_name = $putVars["last_name"];
            $userObj->email = $putVars["email"];
            $userObj->password = $putVars["password"];
            $userObj->operation_claim_id = $putVars["operation_claim_id"];
            echo $userManager->Update($userObj);
            break;
        case 'DELETE':
            $userManager = new UserManager();
            parse_str(file_get_contents("php://input"),$putVars);
            $userId = $putVars["userId"];
            echo $userManager->Delete($userId);
            break;
    }
?>