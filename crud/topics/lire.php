<?php
// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    include_once '../../config/Database.php';
    include_once '../../models/Topic.php';
    include_once '../../repository/TopicRepo.php';

    $database = new Database();
    $db = $database->getConnection();

    $topic = new Topic();
    $topicRepo = new TopicRepo($db);

    $stmt = $topicRepo->lire();

    if($stmt->rowCount() > 0){
        $tableauTopics = [];
        $tableauTopics['topics'] = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $prod = [
                "id" => $id,
                "title" => $title,
            
            ];

            $tableauTopics['topics'][] = $prod;
        }

        http_response_code(200);

        echo json_encode($tableauTopics);
    }

}else{
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}