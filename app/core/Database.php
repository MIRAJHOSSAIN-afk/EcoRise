<?php
/**
 * Database Connection Class
 * Handles database connections using Singleton pattern
 */
class Database {
    private static $instance = null;
    private $conn;
    
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'ecorise';
    
    private function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
        
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->conn;
    }
    
    // Prevent cloning
    private function __clone() {}
}
