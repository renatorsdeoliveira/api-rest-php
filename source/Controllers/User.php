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

            if(count($erros) > 0){
                header("HTTP/1.1 400 Bad Request");
                echo json_encode(array("respose" => "Há campos invalidos no formulario", "fields" => $erros));
                exit;  
            }

            
            $user = new User();
            $user->first_name = $data->first_name;
            $user->last_name = $data->last_name;
            $user->email = $data->email;
            $user->save();


            if($user->fail()){
                header("HTTP/1.1 500 Internal Server Error");
                echo json_encode(array("respose" => "Metodo não Previsto na API"));
                exit;
            }

            header("HTTP/1.1 201 Created");
            echo json_encode(array("respose" => "Usuario criado com sucesso!!!"));


        break;

        case "GET":
            header("HTTP/1.1 200 OK");

            $users = new User();
            if($users->find()->Count() > 0){
                $return = array();
                foreach($users->find()->fetch(true) as $user){
                    // Tratamento dos dados vindos do banco
                    array_push( $return, $user->data());
                }
                echo json_encode(array("response" => $return)); 
            }else{
                echo json_encode(array("response" => "Nenhum usúario localizado!!!")); 
            }
        break;
        
        default:
            header("HTTP/1.1 401 Unauthorized");
                echo json_encode(array("respose" => "Metodo não encontrado"));
        break;
    }
