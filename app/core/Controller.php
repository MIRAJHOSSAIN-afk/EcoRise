<?php
/**
 * Base Controller Class
 * All controllers extend this class
 */
class Controller {
    
    /**
     * Load a model
     */
    protected function model($model) {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }
    
    /**
     * Load a view
     */
    protected function view($view, $data = []) {
        extract($data);
        require_once '../app/views/' . $view . '.php';
    }
    
    /**
     * Redirect to another page
     */
    protected function redirect($url) {
        header('Location: ' . $url);
        exit();
    }
    
    /**
     * Check if user is logged in
     */
    protected function isLoggedIn() {
        return isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
    }
    
    /**
     * Require authentication
     */
    protected function requireAuth() {
        if (!$this->isLoggedIn()) {
            $this->redirect('signin.php');
        }
    }
    
    /**
     * Check if user is admin
     */
    protected function isAdmin() {
        return isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin';
    }
}
