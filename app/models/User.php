<?php
require_once __DIR__ . '/../core/Database.php';

/**
 * User Model
 * Handles all user-related database operations
 */
class User {
    private $db;
    private $conn;
    
    public function __construct() {
        $this->db = Database::getInstance();
        $this->conn = $this->db->getConnection();
    }
    
    /**
     * Find user by email
     */
    public function findByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            return $result->fetch_assoc();
        }
        return null;
    }
    
    /**
     * Find user by ID
     */
    public function findById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            return $result->fetch_assoc();
        }
        return null;
    }
    
    /**
     * Create new user
     */
    public function create($name, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashedPassword);
        
        if ($stmt->execute()) {
            return $this->conn->insert_id;
        }
        return false;
    }
    
    /**
     * Update user profile
     */
    public function update($id, $name, $address, $contact) {
        $stmt = $this->conn->prepare("UPDATE users SET name=?, address=?, contact=? WHERE id=?");
        $stmt->bind_param("sssi", $name, $address, $contact, $id);
        return $stmt->execute();
    }
    
    /**
     * Verify user password
     */
    public function verifyPassword($email, $password) {
        $user = $this->findByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
    
    /**
     * Change user password
     */
    public function changePassword($email, $currentPassword, $newPassword) {
        $user = $this->verifyPassword($email, $currentPassword);
        if ($user) {
            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            $stmt = $this->conn->prepare("UPDATE users SET password = ? WHERE email = ?");
            $stmt->bind_param("ss", $hashedPassword, $email);
            return $stmt->execute();
        }
        return false;
    }
    
    /**
     * Get all users (for admin)
     */
    public function getAll() {
        $result = $this->conn->query("SELECT id, name, email, user_type, user_status FROM users");
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        return $users;
    }
}
