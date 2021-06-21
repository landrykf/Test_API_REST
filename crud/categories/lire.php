<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    include_once '../../config/Database.php';
    include_once '../../models/Category.php';
    include_once '../../repository/CategoryRepo.php';

    $database = new Database();
    $db = $database->getConnection();

    $category = new Category();
    $categoryRepo = new CategoryRepo($db);

    $stmt = $categoryRepo->lire();
    

    if($stmt->rowCount() > 0){
        $tableauCategories = [];
        $tableauCategories['categories'] = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $prod = [
                "id" => $id,
                "label" => $label

            ];

            $tableauCategories['categories'][] = $prod;
        }

        http_response_code(200);

        echo json_encode($tableauCategories);
    }

}else{
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}