<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    include_once '../../config/Database.php';
    include_once '../../models/User.php';
    include_once '../../repository/UserRepo.php';

    $database = new Database();
    $db = $database->getConnection();

    $user = new User();
    $userRepo = new UserRepo($db);

    $stmt = $userRepo->lire();

    if($stmt->rowCount() > 0){
        $tableauUsers = [];
        $tableauUsers['users'] = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $prod = [
                "id" => $id,
                "email" => $email,
                "password" => $password,
                "birthDate" => $birthDate,
              
            ];

            $tableauUsers['users'][] = $prod;
        }

        http_response_code(200);

        echo json_encode($tableauUsers);
    }

}else{
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}