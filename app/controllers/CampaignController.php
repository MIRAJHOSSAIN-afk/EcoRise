<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Campaign.php';

/**
 * Campaign Controller
 * Handles campaign-related operations
 */
class CampaignController extends Controller {
    private $campaignModel;
    
    public function __construct() {
        session_start();
        $this->campaignModel = new Campaign();
    }
    
    /**
     * Get all campaigns (for AJAX/JSON)
     */
    public function getAllJson() {
        header('Content-Type: application/json');
        $campaigns = $this->campaignModel->getAll();
        echo json_encode($campaigns);
        exit();
    }
    
    /**
     * Show campaign listing page
     */
    public function index() {
        $this->requireAuth();
        $data = [
            'campaigns' => $this->campaignModel->getAll()
        ];
        $this->view('campaigns/index', $data);
    }
    
    /**
     * Show add campaign form
     */
    public function add() {
        $this->requireAuth();
        
        $data = ['error' => '', 'success' => ''];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->processAdd();
        }
        
        $this->view('campaigns/add', $data);
    }
    
    /**
     * Process add campaign
     */
    private function processAdd() {
        $title = trim($_POST['title']);
        $goal = trim($_POST['goal']);
        $target_amount = floatval($_POST['target_amount']);
        $location = trim($_POST['location']);
        
        // Validation
        if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
            return ['error' => 'Invalid title format.', 'success' => ''];
        }
        
        if ($target_amount < 0) {
            return ['error' => 'Target amount cannot be negative.', 'success' => ''];
        }
        
        if ($this->campaignModel->titleExists($title)) {
            return ['error' => 'Campaign already exists.', 'success' => ''];
        }
        
        // Handle image upload
        $image_url = $this->handleImageUpload();
        if (!$image_url) {
            return ['error' => 'Error uploading image.', 'success' => ''];
        }
        
        // Create campaign
        if ($this->campaignModel->create($title, $goal, $target_amount, $location, $image_url)) {
            return ['error' => '', 'success' => 'Campaign added successfully!'];
        } else {
            return ['error' => 'Error creating campaign.', 'success' => ''];
        }
    }
    
    /**
     * Handle image upload
     */
    private function handleImageUpload() {
        if (!isset($_FILES['image']) || $_FILES['image']['error'] != 0) {
            return false;
        }
        
        $image = $_FILES['image'];
        $image_name = uniqid('image', true) . '.' . pathinfo($image['name'], PATHINFO_EXTENSION);
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
        
        if (!in_array($image_ext, $allowed_types)) {
            return false;
        }
        
        if ($image['size'] > 5000000) { // 5MB
            return false;
        }
        
        $upload_dir = 'assets/campaigns/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        $image_path = $upload_dir . $image_name;
        if (move_uploaded_file($image['tmp_name'], $image_path)) {
            return $image_path;
        }
        
        return false;
    }
    
    /**
     * Update campaign
     */
    public function update() {
        $this->requireAuth();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['campaign_id']);
            $title = trim($_POST['title']);
            $goal = trim($_POST['goal']);
            $target_amount = floatval($_POST['target_amount']);
            
            if ($this->campaignModel->update($id, $title, $goal, $target_amount)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Update failed']);
            }
            exit();
        }
    }
    
    /**
     * Delete campaign
     */
    public function delete() {
        $this->requireAuth();
        
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            if ($this->campaignModel->delete($id)) {
                $this->redirect('manage_campaigns.php?success=deleted');
            }
        }
        $this->redirect('manage_campaigns.php');
    }
}
