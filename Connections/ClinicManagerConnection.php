<?php 
    require_once("/wamp64/www/kds/Business/ClinicManager.php");
    $method = $_SERVER["REQUEST_METHOD"];
    
    switch ($method) {
        case 'POST':
            $clinicManager = new ClinicManager();
            parse_str(file_get_contents("php://input"),$putVars);
            $clinic_name = $putVars["clinic_name"];
            echo $clinicManager->Add($clinic_name);
            break;
        case 'PUT': 
            echo "Put";
            break;
        case 'DELETE':
            $clinicManager = new ClinicManager();
            parse_str(file_get_contents("php://input"),$putVars);
            $clinicId = $putVars["clinicId"];
            echo $clinicManager->Delete($clinicId);
            break;
    }
?>