<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if($_SERVER['REQUEST_METHOD'] == 'PUT'){
    include_once '../../config/Database.php';
    include_once '../../models/Post.php';
    include_once '../../repository/PostRepo.php';

    $database = new Database();
    $db = $database->getConnection();

    $post = new Post();
    $postRepo = new PostRepo($db);

    $donnees = json_decode(file_get_contents("php://input"));


    
    if(!empty($donnees->id) && !empty($donnees->postDate) && !empty($donnees->content)){

        
        $post->id = $donnees->id;
        $post->postDate = $donnees->postDate;
        $post->content = $donnees->content;
    

        if($postRepo->modifier($post)){

            http_response_code(200);
            echo json_encode(["message" => "La modification a été effectuée"]);
        }else{

            http_response_code(503);
            echo json_encode(["message" => "La modification n'a pas été effectuée"]);         
        }
    }
}else{
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}