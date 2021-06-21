<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if($_SERVER['REQUEST_METHOD'] == 'PUT'){
    include_once '../../config/Database.php';
    include_once '../../models/Category.php';
    include_once '../../repository/CategoryRepo.php';

    $database = new Database();
    $db = $database->getConnection();

    $category = new Category();
    $categoryRepo = new CategoryRepo($db);

    $donnees = json_decode(file_get_contents("php://input"));


    
    if(!empty($donnees->id) && !empty($donnees->label)){

        
        $category->id = $donnees->id;
        $category->label = $donnees->label;
        
        if($categoryRepo->modifier($category)){
            

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