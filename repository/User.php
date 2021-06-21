<?php
    

include_once '../models/User.php';


class UserRepo {

  private $connexion;
  private $table = "user";


    public function __construct($db){
        $this->connexion = $db;
    }

    /**
     * Lecture des produits
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
     * Créer un produit
     *
     * @return void
     */
    public function creer($user){

        
        $sql = "INSERT INTO " . $this->table . " SET email=:email, password=:password, birthDate=:birthDate";

        
        $query = $this->connexion->prepare($sql);

        
        $user->email=htmlspecialchars(strip_tags($user->email));
        $user->password=htmlspecialchars(strip_tags($user->password));
        $user->birthDate=htmlspecialchars(strip_tags($user->birthDate));
       

        
        $query->bindParam(":email", $user->email);
        $query->bindParam(":password", $user->password);
        $query->bindParam(":birthDate", $user->birthDate);
  

        
        if($query->execute()){
            return true;
        }
        return false;
    }

   
    /**
     * Supprimer un produit
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
     * Mettre à jour un produit
     *
     * @return void
     */
    public function modifier($user){
       
        $sql = "UPDATE " . $this->table . " SET email=:email, password=:password, birthDate=:birthDate WHERE id=:id";
        
        $query = $this->connexion->prepare($sql);
        
        $user->email=htmlspecialchars(strip_tags($user->email));
        $user->password=htmlspecialchars(strip_tags($user->password));
        $user->birthdate=htmlspecialchars(strip_tags($user->birthdate));
        $user->id=htmlspecialchars(strip_tags($user->id));
        
        $query->bindParam(':email', $user->email);
        $query->bindParam(':password', $user->password);
        $query->bindParam(':birthDate', $user->birthDate);
        $query->bindParam(':id', $user->id);
        
        if($query->execute()){
            return true;
        }
        
        return false;
    }
}