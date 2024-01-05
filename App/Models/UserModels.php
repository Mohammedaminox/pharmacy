<?php

namespace App\Models;
use PDO;
use App\Models\Database;
class UserModels{
    public $db;
    public function __construct() {
        $databaseInstance = Database::getInstance();
        $this->db = $databaseInstance->getDB();
    }

    public function GetAllUsers(){ 
        $stmt = $this->db->query('SELECT * FROM `users`');
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }    
    public function GetAllUserByCIN($cin){ 
        $stmt = $this->db->prepare('SELECT * FROM `users` WHERE CIN = :cin');
        $stmt->bindParam(':cin' , $cin , PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }    

    public function DeleteUsers($cin){
        $stmt = $this->db->prepare('DELETE FROM `users` WHERE CIN = :cin');
        $stmt->bindParam(':cin' , $cin , PDO::PARAM_STR);
        $stmt->execute();
    }
    
    public function ModifyUsers($cin , $fullname , $email){
        $stmt = $this->db->prepare('UPDATE users SET CIN = :cin, full_name = :fullname, email = :email WHERE CIN = :cin');
        
        $stmt->bindParam(':cin' , $cin , PDO::PARAM_STR);
        $stmt->bindParam(':fullname' , $fullname , PDO::PARAM_STR);
        $stmt->bindParam(':email' , $email , PDO::PARAM_STR);
        $stmt->execute();
    }
}



?>