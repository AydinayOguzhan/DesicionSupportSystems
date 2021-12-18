<?php
require_once("/wamp64/www/kds/Business/OperationClaimManager.php");
require_once("/wamp64/www/kds/Entities/operationClaim.php");
$method = $_SERVER["REQUEST_METHOD"];

function deneme (){
    $operationClaimManager = new OperationClaimManager();
    $response = $operationClaimManager->GetAll();
    // foreach ($response as $key => $value) {
    //     echo "$value";
    // }
    // print_r($response);
    echo json_encode($response);
}

switch ($method) {
    case 'POST':
        echo 1;
        break;
    case 'PUT':
        echo 2;
        break;
    case 'DELETE':
        echo 3;
        break;
    case 'GET':
        deneme();
        break;
}
