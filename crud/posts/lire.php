<?php
// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    include_once '../../config/Database.php';
    include_once '../../models/Post.php';
    include_once '../../repository/PostRepo.php';

    $database = new Database();
    $db = $database->getConnection();

    $post = new Post();
    $postRepo = new PostRepo($db);

    $stmt = $postRepo->lire();

    if($stmt->rowCount() > 0){
        $tableauPosts = [];
        $tableauPosts['posts'] = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $prod = [
                "id" => $id,
                "postDate" => $postDate,
                "content" => $content,
            
            ];


            $tableauPosts['posts'][] = $prod;
        }

        http_response_code(200);

        echo json_encode($tableauPosts);
    }

}else{
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}