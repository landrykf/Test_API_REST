<?php
    

include_once '../models/Post.php';


class PostRepo {

  private $connexion;
  private $table = "post";


    public function __construct($db){
        $this->connexion = $db;
    }

    /**
     * Lecture 
     *
     * @return void
     */
    public function lire(){
        $sql = "SELECT * FROM " . $this->table;

        $query = $this->connexion->prepare($sql);

        $query->execute();

        return $query;
    }

    /**
     * Créer 
     *
     * @return void
     */
    public function creer($post){

        $sql = "INSERT INTO " . $this->table . " SET postDate=:postDate, content=:content";

        $query = $this->connexion->prepare($sql);

        $post->content=htmlspecialchars(strip_tags($post->content));
        $post->postDate=htmlspecialchars(strip_tags($post->postDate));
       

        $query->bindParam(":content", $post->content);
        $query->bindParam(":postDate", $post->postDate);
  

        if($query->execute()){
            return true;
        }
        return false;
    }

   
    /**
     * Supprimer 
     *
     * @return void
     */
    public function supprimer($post){
        $sql = "DELETE FROM " . $this->table . " WHERE id = ?";

        $query = $this->connexion->prepare($sql);

        $post->id=htmlspecialchars(strip_tags($post->id));

        $query->bindParam(1, $post->id);

        if($query->execute()){
            return true;
        }
        
        return false;
    }

    /**
     * Mettre à jour 
     *
     * @return void
     */
    public function modifier($post){
       
        $sql = "UPDATE " . $this->table . " SET postDate=:postDate, content=:content WHERE id=:id";
        
        $query = $this->connexion->prepare($sql);

        $post->postDate=htmlspecialchars(strip_tags($post->postDate));
        $post->content=htmlspecialchars(strip_tags($post->content));
        $post->id=htmlspecialchars(strip_tags($post->id));
        
        $query->bindParam(':postDate', $post->postDate);
        $query->bindParam(':content', $post->content);
        $query->bindParam(':id', $post->id);
        
        if($query->execute()){
            return true;
        }
        
        return false;
    }
}