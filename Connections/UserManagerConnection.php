<?php 
    $method = $_SERVER["REQUEST_METHOD"];
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
    }
?>