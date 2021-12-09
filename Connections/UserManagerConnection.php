<?php 
    require_once("/wamp64/www/kds/Business/UserManager.php");
    $method = $_SERVER["REQUEST_METHOD"];
    var_dump($method);
    // parse_str(file_get_contents("php://input"),$putVars);
    // $type = $putVars["type"];
    // echo $type;
    // switch ($method) {
    //     case 'POST':
    //         if ($type == "delete") {
    //             echo "delete";
    //         }else{
    //             echo 1;
    //         }
    //         break;
    //     case 'PUT': 
    //         echo 2;
    //         break;
    //     case 'delete':
    //         $userManager = new UserManager();
    //         parse_str(file_get_contents("php://input"),$putVars);
    //         $userId = $putVars["userId"];
    //         $userManager->Delete($userId);
    //         break;
    // }
?>