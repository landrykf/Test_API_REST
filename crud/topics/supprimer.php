<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
    include_once '../../config/Database.php';
    include_once '../../models/Topic.php';
    include_once '../../repository/TopicRepo.php';

    $database = new Database();
    $db = $database->getConnection();

    $topic = new Topic();
    $topicRepo = new TopicRepo($db);

    $donnees = json_decode(file_get_contents("php://input"));

    if(!empty($donnees->id)){
        $topic->id = $donnees->id;

        if($topicRepo->supprimer($topic)){

            http_response_code(200);
            echo json_encode(["message" => "topic deleted"]);
        }else{

            http_response_code(503);
            echo json_encode(["message" => "topic not deleted"]);         
        }
    }

else{
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}
}