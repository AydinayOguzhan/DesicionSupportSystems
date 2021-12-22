<?php 
    require_once("/wamp64/www/kds/Business/MajorManager.php");
    require_once("/wamp64/www/kds/Entities/major.php");
    $method = $_SERVER["REQUEST_METHOD"];
    
    switch ($method) {
        case 'POST':
            $majorManager = new MajorManager();
            parse_str(file_get_contents("php://input"),$putVars);
            $majorName = $putVars["majorName"];
            echo $majorManager->Add($majorName);
            break;
        case 'PUT': 
            $majorManager = new MajorManager();
            $major = new Major();
            parse_str(file_get_contents("php://input"),$putVars);
            $major->id = $putVars["majorId"];
            $major->majorName = $putVars["majorName"];
            echo $majorManager->Update($major);
            break;
        case 'DELETE':
            $majorManager = new MajorManager();
            parse_str(file_get_contents("php://input"),$putVars);
            $majorId = $putVars["id"];
            echo $majorManager->Delete($majorId);
            break;
    }
?>