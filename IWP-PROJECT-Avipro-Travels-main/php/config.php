<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'avipro_travels');
define('DB_USER', 'root');
define('DB_PASS', '');

// Website Configuration
define('SITE_NAME', 'Avipro Travels');
define('SITE_URL', 'http://localhost/avipro-travels');
define('ADMIN_EMAIL', 'admin@aviprotravels.com');

// File Upload Configuration
define('UPLOAD_PATH', '../assets/uploads/');
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_TYPES', ['image/jpeg', 'image/png', 'image/gif']);



// Create database connection
function getDBConnection() {
    try {
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch(PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

// Sanitize input data
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// JSON Response helper
function jsonResponse($success, $message, $data = []) {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => $success,
        'message' => $message,
        'data' => $data
    ]);
    exit;
}
?>