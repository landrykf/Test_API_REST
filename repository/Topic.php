<?php
    

include_once '../models/Topic.php';


class TopicRepo {

  private $connexion;
  private $table = "topic";


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
    public function creer($topic){

        $sql = "INSERT INTO " . $this->table . " SET title=:title";

        $query = $this->connexion->prepare($sql);

        $topic->title=htmlspecialchars(strip_tags($topic->title));
       
        $query->bindParam(":title", $topic->title);
    
  

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
    public function supprimer($topic){
        
        $sql = "DELETE FROM " . $this->table . " WHERE id = ?";

        
        $query = $this->connexion->prepare($sql);

        
        $topic->id=htmlspecialchars(strip_tags($topic->id));

        
        $query->bindParam(1, $topic->id);

        
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
    public function modifier($topic){
       
       
        $sql = "UPDATE " . $this->table . " SET title=:title WHERE id=:id";
        
        
        $query = $this->connexion->prepare($sql);
        
        $topic->title=htmlspecialchars(strip_tags($topic->title));
        $topic->id=htmlspecialchars(strip_tags($topic->id));
        
        
        $query->bindParam(':title', $topic->title);
      
        $query->bindParam(':id', $topic->id);
        
        
        if($query->execute()){
            return true;
        }
        
        return false;
    }
}