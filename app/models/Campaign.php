<?php
require_once __DIR__ . '/../core/Database.php';

/**
 * Campaign Model
 * Handles all campaign-related database operations
 */
class Campaign {
    private $db;
    private $conn;
    
    public function __construct() {
        $this->db = Database::getInstance();
        $this->conn = $this->db->getConnection();
    }
    
    /**
     * Get all campaigns
     */
    public function getAll() {
        $sql = "SELECT id, title, goal, target_amount, raised_amount, image_url, location FROM campaigns";
        $result = $this->conn->query($sql);
        
        $campaigns = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $campaigns[] = $row;
            }
        }
        return $campaigns;
    }
    
    /**
     * Get campaign by ID
     */
    public function findById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM campaigns WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            return $result->fetch_assoc();
        }
        return null;
    }
    
    /**
     * Create new campaign
     */
    public function create($title, $goal, $target_amount, $location, $image_url) {
        $stmt = $this->conn->prepare("INSERT INTO campaigns (title, goal, target_amount, location, image_url, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("ssdss", $title, $goal, $target_amount, $location, $image_url);
        
        if ($stmt->execute()) {
            return $this->conn->insert_id;
        }
        return false;
    }
    
    /**
     * Update campaign
     */
    public function update($id, $title, $goal, $target_amount) {
        $stmt = $this->conn->prepare("UPDATE campaigns SET title = ?, goal = ?, target_amount = ? WHERE id = ?");
        $stmt->bind_param("ssdi", $title, $goal, $target_amount, $id);
        return $stmt->execute();
    }
    
    /**
     * Delete campaign
     */
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM campaigns WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    
    /**
     * Update raised amount
     */
    public function updateRaisedAmount($id, $amount) {
        $campaign = $this->findById($id);
        if ($campaign) {
            $newAmount = $campaign['raised_amount'] + $amount;
            $stmt = $this->conn->prepare("UPDATE campaigns SET raised_amount = ? WHERE id = ?");
            $stmt->bind_param("di", $newAmount, $id);
            return $stmt->execute();
        }
        return false;
    }
    
    /**
     * Check if campaign title exists
     */
    public function titleExists($title) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) as count FROM campaigns WHERE title = ?");
        $stmt->bind_param("s", $title);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['count'] > 0;
    }
}
