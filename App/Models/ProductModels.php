<?php

namespace App\Models;
use PDO;
class ProductModels{
    public $db;
    public function __construct() {
        $databaseInstance = Database::getInstance();
        $this->db = $databaseInstance->getDB();
    }

    public function AddProduct($nom, $description, $quantete, $prix){
        $stmt = $this->db->prepare("INSERT INTO `medicament` (`nom`, `description`, `quantite_stock`, `prix`) VALUES (:nom, :description, :quantete, :prix)");

        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':quantete', $quantete, PDO::PARAM_INT);
        $stmt->bindParam(':prix', $prix, PDO::PARAM_INT);
    
        $stmt->execute();
    }
    
    public function GetAllProducts(){ 
        $stmt = $this->db->query('SELECT * FROM `medicament` WHERE isDeleted = 0 ORDER BY date_creation DESC');
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }    

    public function GetProductByID($id){ 
        $stmt = $this->db->prepare('SELECT * FROM `medicament` WHERE id = :id');
        $stmt->bindParam(':id' , $id , PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
     

    public function DeleteProduct($id){
        $stmt = $this->db->prepare("UPDATE `medicament` SET 
       `IsDeleted`='1' WHERE id = :id");
        $stmt->bindParam(':id' , $id , PDO::PARAM_STR);
        $stmt->execute();
    }
    
    public function ModifyProduct($id, $nom, $description, $quantete, $prix){
        $stmt = $this->db->prepare("UPDATE `medicament` 
            SET `nom`=:nom, `description`=:description,
            `quantite_stock`=:quantete, `prix`=:prix 
            WHERE id = :id");
    
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':quantete', $quantete, PDO::PARAM_STR); 
        $stmt->bindParam(':prix', $prix, PDO::PARAM_STR); 
    
        $stmt->execute();
    }
    
}



?>