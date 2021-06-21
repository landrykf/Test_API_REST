<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include_once '../../config/Database.php';
    include_once '../../models/Topic.php';
    include_once '../../repository/TopicRepo.php';

    $database = new Database();
    $db = $database->getConnection();

    $topic = new Topic();
    $topicRepo = new TopicRepo($db);


    $donnees = json_decode(file_get_contents("php://input"));

    
    if(!empty($donnees->title)){


        $topic->title = $donnees->title;
       

        if($topicRepo->creer($topic)){

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