<?php
require_once 'config.php';

class BookingManager {
    private $pdo;
    
    public function __construct() {
        $this->pdo = getDBConnection();
    }
    
    // Get all bookings
    public function getBookings($limit = null) {
        $sql = "SELECT b.*, p.title as package_name 
                FROM bookings b 
                LEFT JOIN packages p ON b.package_id = p.id 
                ORDER BY b.created_at DESC";
                
        if ($limit) {
            $sql .= " LIMIT " . intval($limit);
        }
        
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Get booking by ID
    public function getBooking($id) {
        $stmt = $this->pdo->prepare("SELECT b.*, p.title as package_name 
                                   FROM bookings b 
                                   LEFT JOIN packages p ON b.package_id = p.id 
                                   WHERE b.id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Add new booking
    public function addBooking($data) {
        $sql = "INSERT INTO bookings (package_id, name, email, phone, travel_date, persons, message) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['package_id'] ?? null,
            $data['name'],
            $data['email'],
            $data['phone'],
            $data['travel_date'],
            $data['persons'],
            $data['message'] ?? ''
        ]);
    }
    
    // Update booking status
    public function updateBookingStatus($id, $status) {
        $stmt = $this->pdo->prepare("UPDATE bookings SET status = ? WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }
    
    // Delete booking
    public function deleteBooking($id) {
        $stmt = $this->pdo->prepare("DELETE FROM bookings WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    // Get booking statistics
    public function getStats() {
        $stats = [];
        
        // Total bookings
        $stmt = $this->pdo->query("SELECT COUNT(*) as total FROM bookings");
        $stats['total'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        
        // Status counts
        $stmt = $this->pdo->query("SELECT status, COUNT(*) as count FROM bookings GROUP BY status");
        $statusCounts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($statusCounts as $row) {
            $stats[$row['status']] = $row['count'];
        }
        
        return $stats;
    }
}

// Handle booking operations
if ($_POST['action'] ?? '') {
    $bookingManager = new BookingManager();
    
    switch ($_POST['action']) {
        case 'add_booking':
            $success = $bookingManager->addBooking($_POST);
            jsonResponse($success, $success ? 'Booking submitted successfully' : 'Failed to submit booking');
            break;
            
        case 'get_bookings':
            require_once 'auth.php';
            $auth = new Auth();
            
            if (!$auth->isLoggedIn()) {
                jsonResponse(false, 'Unauthorized access');
            }
            
            $bookings = $bookingManager->getBookings();
            jsonResponse(true, 'Bookings retrieved', $bookings);
            break;
            
        case 'update_status':
            require_once 'auth.php';
            $auth = new Auth();
            
            if (!$auth->isLoggedIn()) {
                jsonResponse(false, 'Unauthorized access');
            }
            
            $success = $bookingManager->updateBookingStatus($_POST['id'], $_POST['status']);
            jsonResponse($success, $success ? 'Status updated successfully' : 'Failed to update status');
            break;
    }
}
?>