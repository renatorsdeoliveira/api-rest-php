<?php 

    namespace Source\Controller;

    require "../../vendor/autoload.php";
    require "../config.php";
    
    switch ($_SERVER["REQUEST_METHOD"]) {
        case  "POST":
                $data = json_decode(file_get_contents("php://input"), false);
                
                var_dump($data);
            break;
        
        default:
            header("HTTP/1.1 401 Unauthorized");
                echo json_encode(array("respose" => "Metodo não encontrado"));
            break;
    }
