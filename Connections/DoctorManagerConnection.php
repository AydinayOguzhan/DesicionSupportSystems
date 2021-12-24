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
            $wage = $putVars["wage"];
            try {
                echo $doctorManager->Add($doctor,$workplace,$wage);
            } catch (\Throwable $th) {
                echo $th->getMessage();
            }
            break;
        case 'PUT': 
            $doctorManager = new DoctorManager();
            $doctor = new Doctor();
            parse_str(file_get_contents("php://input"),$putVars);
            $doctor->id = $putVars["doctorId"];
            $doctor->major_id = $putVars["majorId"];
            $doctor->first_name = $putVars["doctorFirstName"];
            $doctor->last_name = $putVars["doctorLastName"];
            $workplace = $putVars["clinicId"];
            $wage = $putVars["wage"];
            try {
                echo $doctorManager->Update($doctor,$workplace,$wage);
            } catch (\Throwable $th) {
                echo $th->getMessage();
            }
            break;
        case 'DELETE':
            $doctorManager = new DoctorManager();
            parse_str(file_get_contents("php://input"),$putVars);
            $doctorId = $putVars["doctorId"];
            echo $doctorManager->Delete($doctorId);
            break;
    }
?>