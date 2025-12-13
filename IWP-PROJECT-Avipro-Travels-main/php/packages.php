<?php
require_once 'config.php';

class PackageManager {
    private $pdo;
    
    public function __construct() {
        $this->pdo = getDBConnection();
    }
    
    // Get all packages
    public function getPackages($limit = null) {
        $sql = "SELECT * FROM packages ORDER BY created_at DESC";
        if ($limit) {
            $sql .= " LIMIT " . intval($limit);
        }
        
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Get package by ID
    public function getPackage($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM packages WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Add new package
    public function addPackage($data, $image = null) {
        $sql = "INSERT INTO packages (title, description, price, duration, destination, image_url, itinerary, inclusions) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->pdo->prepare($sql);
        $success = $stmt->execute([
            $data['title'],
            $data['description'],
            $data['price'],
            $data['duration'],
            $data['destination'],
            $image,
            $data['itinerary'] ?? '',
            $data['inclusions'] ?? ''
        ]);
        
        return $success ? $this->pdo->lastInsertId() : false;
    }
    
    // Update package
    public function updatePackage($id, $data, $image = null) {
        $sql = "UPDATE packages SET title = ?, description = ?, price = ?, duration = ?, 
                destination = ?, itinerary = ?, inclusions = ?";
        
        $params = [
            $data['title'],
            $data['description'],
            $data['price'],
            $data['duration'],
            $data['destination'],
            $data['itinerary'] ?? '',
            $data['inclusions'] ?? ''
        ];
        
        if ($image) {
            $sql .= ", image_url = ?";
            $params[] = $image;
        }
        
        $sql .= " WHERE id = ?";
        $params[] = $id;
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }
    
    // Delete package
    public function deletePackage($id) {
        $stmt = $this->pdo->prepare("DELETE FROM packages WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    // Handle image upload
    public function uploadImage($file) {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('File upload error');
        }
        
        if ($file['size'] > MAX_FILE_SIZE) {
            throw new Exception('File too large');
        }
        
        $fileType = mime_content_type($file['tmp_name']);
        if (!in_array($fileType, ALLOWED_TYPES)) {
            throw new Exception('Invalid file type');
        }
        
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '.' . $extension;
        $filepath = UPLOAD_PATH . $filename;
        
        if (!move_uploaded_file($file['tmp_name'], $filepath)) {
            throw new Exception('Failed to move uploaded file');
        }
        
        return $filename;
    }
}

// Handle package operations
if ($_POST['action'] ?? '') {
    require_once 'auth.php';
    $auth = new Auth();
    
    if (!$auth->isLoggedIn()) {
        jsonResponse(false, 'Unauthorized access');
    }
    
    $packageManager = new PackageManager();
    
    switch ($_POST['action']) {
        case 'get_packages':
            $packages = $packageManager->getPackages();
            jsonResponse(true, 'Packages retrieved', $packages);
            break;
            
        case 'add_package':
            try {
                $image = null;
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $image = $packageManager->uploadImage($_FILES['image']);
                }
                
                $packageId = $packageManager->addPackage($_POST, $image);
                if ($packageId) {
                    jsonResponse(true, 'Package added successfully', ['id' => $packageId]);
                } else {
                    jsonResponse(false, 'Failed to add package');
                }
            } catch (Exception $e) {
                jsonResponse(false, $e->getMessage());
            }
            break;
            
        case 'update_package':
            try {
                $image = null;
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $image = $packageManager->uploadImage($_FILES['image']);
                }
                
                $success = $packageManager->updatePackage($_POST['id'], $_POST, $image);
                jsonResponse($success, $success ? 'Package updated successfully' : 'Failed to update package');
            } catch (Exception $e) {
                jsonResponse(false, $e->getMessage());
            }
            break;
            
        case 'delete_package':
            $success = $packageManager->deletePackage($_POST['id']);
            jsonResponse($success, $success ? 'Package deleted successfully' : 'Failed to delete package');
            break;
    }
}
?>