<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include_once '../../config/Database.php';
    include_once '../../models/User.php';
    include_once '../../repository/UserRepo.php';

    $database = new Database();
    $db = $database->getConnection();

    $user = new User();
    $userRepo = new UserRepo($db);

    $donnees = json_decode(file_get_contents("php://input"));

    var_dump($donnees); 
   
    
    if(!empty($donnees->email) && !empty($donnees->password) && !empty($donnees->birthDate)){


        $user->email = $donnees->email;
        $user->password = $donnees->password;
        $user->birthDate = $donnees->birthDate;

        if($userRepo->creer($user)){

            http_response_code(201);
            echo json_encode(["message" => "User added"]);
        }else{

            http_response_code(503);
            echo json_encode(["message" => "User not added"]);         
        }
    }
}else{
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}