<?php 
    require_once("/wamp64/www/kds/Business/DoctorManager.php");
    require_once("/wamp64/www/kds/Entities/doctor.php");
    $method = $_SERVER["REQUEST_METHOD"];
    
    switch ($method) {
        case 'POST':
            $doctorManager = new DoctorManager();
            $doctor = new Doctor();
            parse_str(file_get_contents("php://input"),$putVars);
            $doctor->major_id = $putVars["major_id"];
            $doctor->first_name = $putVars["first_name"];
            $doctor->last_name = $putVars["last_name"];
            $workplace = $putVars["workplace"];
            echo $doctorManager->Add($doctor,$workplace);
            break;
        case 'PUT': 
            echo "Put";
            break;
        case 'DELETE':
            $doctorManager = new DoctorManager();
            parse_str(file_get_contents("php://input"),$putVars);
            $doctorId = $putVars["doctorId"];
            echo $doctorManager->Delete($doctorId);
            break;
    }
?>