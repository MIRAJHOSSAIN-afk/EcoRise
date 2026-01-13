<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models\User.php';

/**
 * User Controller
 * Handles user dashboard and profile operations
 */
class UserController extends Controller {
    private $userModel;
    
    public function __construct() {
        session_start();
        $this->userModel = new User();
    }
    
    /**
     * Show user dashboard
     */
    public function dashboard() {
        $this->requireAuth();
        
        $user_id = $_SESSION['user_id'];
        $user_info = $this->userModel->findById($user_id);
        
        $data = [
            'user_info' => $user_info,
            'errors' => [],
            'success' => ''
        ];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->updateProfile($user_id, $user_info);
        }
        
        $this->view('user/dashboard', $data);
    }
    
    /**
     * Update user profile
     */
    private function updateProfile($user_id, $user_info) {
        $name = trim($_POST['name'] ?? '');
        $address = trim($_POST['address'] ?? '');
        $contact = trim($_POST['contact'] ?? '');
        
        $errors = [];
        
        if ($name === '') {
            $errors[] = "Name cannot be empty.";
        }
        
        if (empty($errors)) {
            if ($this->userModel->update($user_id, $name, $address, $contact)) {
                $_SESSION['name'] = $name;
                $user_info = $this->userModel->findById($user_id);
                return [
                    'user_info' => $user_info,
                    'errors' => [],
                    'success' => 'Profile updated successfully!'
                ];
            } else {
                $errors[] = "Error updating profile.";
            }
        }
        
        return [
            'user_info' => $user_info,
            'errors' => $errors,
            'success' => ''
        ];
    }
    
    /**
     * Change password
     */
    public function changePassword() {
        $this->requireAuth();
        
        $data = ['error' => '', 'success' => ''];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $current_password = $_POST['current_password'];
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];
            
            // Validation
            if (empty($email) || empty($current_password) || empty($new_password) || empty($confirm_password)) {
                $data['error'] = 'All fields are required.';
            } elseif ($new_password !== $confirm_password) {
                $data['error'] = 'New passwords do not match.';
            } elseif (strlen($new_password) < 8) {
                $data['error'] = 'Password must be at least 8 characters.';
            } elseif ($this->userModel->changePassword($email, $current_password, $new_password)) {
                $data['success'] = 'Password changed successfully!';
            } else {
                $data['error'] = 'Current password is incorrect or email not found.';
            }
        }
        
        $this->view('user/change_password', $data);
    }
}
