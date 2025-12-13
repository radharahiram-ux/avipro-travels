<?php
require_once 'config.php';

class Auth {
    private $pdo;
    
    public function __construct() {
        $this->pdo = getDBConnection();
    }
    
    // Admin login
    public function login($username, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM admin_users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_username'] = $user['username'];
            return true;
        }
        
        return false;
    }
    
    // Check if admin is logged in
    public function isLoggedIn() {
        return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
    }
    
    // Logout
    public function logout() {
        session_destroy();
        return true;
    }
    
    // Change password
    public function changePassword($adminId, $currentPassword, $newPassword) {
        $stmt = $this->pdo->prepare("SELECT password_hash FROM admin_users WHERE id = ?");
        $stmt->execute([$adminId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($currentPassword, $user['password_hash'])) {
            $newHash = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $this->pdo->prepare("UPDATE admin_users SET password_hash = ? WHERE id = ?");
            return $stmt->execute([$newHash, $adminId]);
        }
        
        return false;
    }
}

// Handle login request
if ($_POST['action'] ?? '' === 'login') {
    $auth = new Auth();
    $username = sanitizeInput($_POST['username']);
    $password = $_POST['password'];
    
    if ($auth->login($username, $password)) {
        jsonResponse(true, 'Login successful');
    } else {
        jsonResponse(false, 'Invalid username or password');
    }
}

// Handle logout request
if ($_POST['action'] ?? '' === 'logout') {
    $auth = new Auth();
    if ($auth->logout()) {
        jsonResponse(true, 'Logout successful');
    }
}
?>