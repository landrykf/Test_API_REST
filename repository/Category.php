<?php
    

include_once '../models/Category.php';


class CategoryRepo {

  private $connexion;
  private $table = "category";


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
    public function creer($category){

        $sql = "INSERT INTO " . $this->table . " SET label=:label";

        $query = $this->connexion->prepare($sql);

        $category->label=htmlspecialchars(strip_tags($category->label));
        

        $query->bindParam(":label", $category->label);
      
  
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
    public function supprimer($category){
        $sql = "DELETE FROM " . $this->table . " WHERE id = ?";

        $query = $this->connexion->prepare($sql);

        $category->id=htmlspecialchars(strip_tags($category->id));

        $query->bindParam(1, $category->id);

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
    public function modifier($category){
       
        $sql = "UPDATE " . $this->table . " SET label=:label WHERE id=:id";
        
        $query = $this->connexion->prepare($sql);
       
        $category->label=htmlspecialchars(strip_tags($category->label));
        $category->id=htmlspecialchars(strip_tags($category->id));
       
        $query->bindParam(':label', $category->label);
        $query->bindParam(':id', $category->id);
       
        
        if($query->execute()){
            return true;
        }
        
        return false;
    }
}