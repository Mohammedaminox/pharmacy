<?php
namespace App\Models;

use PDO;

class Database {
    private static $instance = null;
    private $db;

    private function __construct() {
        $this->db = new PDO("mysql:host=localhost:3307;dbname=pharmacy", "username", "password");
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getDB() {
        return $this->db;
    }
}

