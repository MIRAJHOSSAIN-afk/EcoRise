<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/User.php';

/**
 * Auth Controller
 * Handles authentication (signin, signup, logout)
 */
class AuthController extends Controller {
    private $userModel;
    
    public function __construct() {
        session_start();
        $this->userModel = new User();
    }
    
    /**
     * Show signin page
     */
    public function signin() {
        if ($this->isLoggedIn()) {
            $this->redirect('homepage.php');
        }
        
        $data = [
            'error' => '',
            'signup_message' => $_SESSION['signup_success'] ?? ''
        ];
        unset($_SESSION['signup_success']);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->processSignin();
        }
        
        $this->view('auth/signin', $data);
    }
    
    /**
     * Process signin form
     */
    private function processSignin() {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $user = $this->userModel->findByEmail($email);
        
        if (!$user) {
            return ['error' => 'No account found with that email address.'];
        }
        
        if ($user['user_status'] === 'inactive') {
            return ['error' => 'Your account is inactive. Please contact support.'];
        }
        
        if (!password_verify($password, $user['password'])) {
            return ['error' => 'Invalid password. Please try again.'];
        }
        
        // Set session variables
        $_SESSION['loggedin'] = true;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['user_type'] = $user['user_type'];
        
        // Redirect based on user type
        if ($user['user_type'] === 'admin') {
            $this->redirect('admin_homepage.php');
        } else {
            $this->redirect('homepage.php');
        }
    }
    
    /**
     * Show signup page
     */
    public function signup() {
        if ($this->isLoggedIn()) {
            $this->redirect('homepage.php');
        }
        
        $data = ['error' => ''];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->processSignup();
        }
        
        $this->view('auth/signup', $data);
    }
    
    /**
     * Process signup form
     */
    private function processSignup() {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        
        // Validation
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            return ['error' => 'Name should only contain letters and spaces.'];
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['error' => 'Invalid email format.'];
        }
        
        if (strlen($password) < 8) {
            return ['error' => 'Password must be at least 8 characters.'];
        }
        
        if (!preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || 
            !preg_match('/\d/', $password) || !preg_match('/[^A-Za-z0-9]/', $password)) {
            return ['error' => 'Password must include upper, lower, number, and symbol.'];
        }
        
        if ($password !== $confirmPassword) {
            return ['error' => 'Passwords do not match.'];
        }
        
        // Check if email exists
        if ($this->userModel->findByEmail($email)) {
            return ['error' => 'This email is already registered.'];
        }
        
        // Create user
        if ($this->userModel->create($name, $email, $password)) {
            $_SESSION['signup_success'] = "Signup successful!";
            $this->redirect('signin.php');
        } else {
            return ['error' => 'Error creating account. Please try again.'];
        }
    }
    
    /**
     * Logout user
     */
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        $this->redirect('index.php');
    }
}
