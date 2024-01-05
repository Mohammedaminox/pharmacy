<?php

namespace App\Models;
use App\Models\Database;
use PDO;
session_start();
class Auth{

    public $db;
    public function __construct() {
        $databaseInstance = Database::getInstance();
        $this->db = $databaseInstance->getDB();
    }

    public function login($email, $password)
        {
            // Use prepared statements to prevent SQL injection
            $query = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row && password_verify($password, $row['password'])) {
                $_SESSION['CIN'] = $row['CIN'];
            
                if ($row['type'] == 'Admin') {
                    header('Location:?route=dashboard');
                    exit(); 
                } else {
                    header('Location:?route=indexuser');
                    exit(); 
                }
            } else {
                header('Location:?route=login&msg');
                exit(); 
            }
        }



    public function register($cin ,$name, $email, $password)
        {
            // Hash the password before storing it in the database
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Specify a valid value for the ENUM column
            $userType = 'PatientEnLigne'; // or 'Admin'

            // Use prepared statements to prevent SQL injection
            $query = "INSERT INTO `users`(`cin`, `full_name`, `email`, `password`, `type`)
            VALUES (:cin, :name, :email, :hashedPassword, :userType)";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':cin', $cin, PDO::PARAM_STR);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':hashedPassword', $hashedPassword, PDO::PARAM_STR);
            $stmt->bindParam(':userType', $userType, PDO::PARAM_STR);

            $result = $stmt->execute();

            if ($result) {
                header('location:?route=login');
            }

            return $result;
        }

    
}


?>