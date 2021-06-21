<?php
// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
    include_once '../../config/Database.php';
    include_once '../../models/Category.php';
    include_once '../../repository/CategoryRepo.php';


    $database = new Database();
    $db = $database->getConnection();

    $category = new Category();
    $categoryRepo = new CategoryRepo($db);

    $donnees = json_decode(file_get_contents("php://input"));
    var_dump($donnees);

    if(!empty($donnees->id)){
        $category->id = $donnees->id;

        if($categoryRepo->supprimer($category)){

            http_response_code(200);
            echo json_encode(["message" => "category deleted"]);

            http_response_code(503);
            echo json_encode(["message" => "category not deleted"]);         
        }
    }

else{
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}
}