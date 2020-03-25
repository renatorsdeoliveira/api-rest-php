<?php 

    namespace Source\Controllers;

    use Source\Models\Validacao;
    use Source\Models\User;

    require "../../vendor/autoload.php";
    require "../config.php";
    
    switch ($_SERVER["REQUEST_METHOD"]) {
        case  "POST":
                $data = json_decode(file_get_contents("php://input"), false);
                
                if(!$data){
                    header("HTTP/1.1 400 Bad Request");
                    echo json_encode(array("respose" => "Metodo não encontrado"));
                    exit;   
                }

                $erros = array();

                if(!Validacao::validacaoString($data->first_name)){
                    array_push($erros, "Nome informado invalido!");
                }
                if(!Validacao::validacaoString($data->last_name)){
                    array_push($erros, "Sobrenome informado invalido!");
                }
                if(!Validacao::validacaoEmail($data->email)){
                    array_push($erros, "Email informado invalido!");
                }

                if(count($erros)>0){
                    header("HTTP/1.1 400 Bad Request");
                    echo json_encode(array("respose" => "Há campos invalidos no formulario", "filds"=>$erros));
                    exit;  
                }


            break;
        
        default:
            header("HTTP/1.1 401 Unauthorized");
                echo json_encode(array("respose" => "Metodo não encontrado"));
            break;
    }
