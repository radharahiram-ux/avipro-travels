<?php
session_start();
require_once '../php/config.php';

// Check if user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: ../admin-login.php');
    exit;
}

$pdo = getDBConnection();
$message = '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_package'])) {
        // Add new package
        $title = sanitizeInput($_POST['title']);
        $description = sanitizeInput($_POST['description']);
        $price = floatval($_POST['price']);
        $duration = sanitizeInput($_POST['duration']);
        $destination = sanitizeInput($_POST['destination']);
        $itinerary = sanitizeInput($_POST['itinerary']);
        $inclusions = sanitizeInput($_POST['inclusions']);
        
        $stmt = $pdo->prepare("INSERT INTO packages (title, description, price, duration, destination, itinerary, inclusions) VALUES (?, ?, ?, ?, ?, ?, ?)");
        if ($stmt->execute([$title, $description, $price, $duration, $destination, $itinerary, $inclusions])) {
            $message = '<div class="success-message">Package added successfully!</div>';
        } else {
            $message = '<div class="error-message">Failed to add package.</div>';
        }
    }
}

// Get all packages
$stmt = $pdo->query("SELECT * FROM packages ORDER BY created_at DESC");
$packages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Packages - Avipro Travels Admin</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <div class="admin-sidebar">
            <div class="admin-logo">
                <h2>Avipro Travels</h2>
                <p>Admin Panel</p>
            </div>
            
            <div class="admin-menu">
                <ul>
                    <li><a href="admin-panel.php">Dashboard</a></li>
                    <li><a href="packages.php" class="active">Travel Packages</a></li>
                    <li><a href="bookings.html">Bookings</a></li>
                    <li><a href="enquiries.php">Enquiries</a></li>

                </ul>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="admin-content">
            <div class="admin-header">
                <h1>Manage Travel Packages</h1>
                <div class="admin-user">
                    Welcome, <?php echo htmlspecialchars($_SESSION['admin_username']); ?> | 
                    <a href="../php/logout.php">Logout</a>
                </div>
            </div>
            
            <?php echo $message; ?>
            
            <!-- Add Package Form -->
            <div class="admin-card">
                <h3>Add New Package</h3>
                <form method="POST" class="admin-form">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div class="form-group">
                            <label for="package-title">Package Title</label>
                            <input type="text" id="package-title" name="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="package-destination">Destination</label>
                            <input type="text" id="package-destination" name="destination" class="form-control" required>
                        </div>
                    </div>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
                        <div class="form-group">
                            <label for="package-price">Price ($)</label>
                            <input type="number" id="package-price" name="price" class="form-control" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label for="package-duration">Duration</label>
                            <input type="text" id="package-duration" name="duration" class="form-control" placeholder="e.g., 7 Days/6 Nights" required>
                        </div>
                        <div class="form-group">
                            <label for="package-image">Package Image (URL)</label>
                            <input type="text" id="package-image" name="image_url" class="form-control" placeholder="https://example.com/image.jpg">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="package-description">Package Description</label>
                        <textarea id="package-description" name="description" class="form-control" rows="5" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="package-itinerary">Itinerary</label>
                        <textarea id="package-itinerary" name="itinerary" class="form-control" rows="4" placeholder="Enter day-by-day itinerary"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="package-inclusions">Inclusions</label>
                        <textarea id="package-inclusions" name="inclusions" class="form-control" rows="3" placeholder="What's included in the package"></textarea>
                    </div>
                    
                    <button type="submit" name="add_package" class="btn">Add Package</button>
                </form>
            </div>
            
            <!-- Packages List -->
            <div class="admin-card">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <h3>All Packages (<?php echo count($packages); ?>)</h3>
                </div>
                
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Package Name</th>
                                <th>Destination</th>
                                <th>Price</th>
                                <th>Duration</th>
                                <th>Created</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($packages as $package): ?>
                            <tr>
                                <td>#PKG<?php echo str_pad($package['id'], 3, '0', STR_PAD_LEFT); ?></td>
                                <td><?php echo htmlspecialchars($package['title']); ?></td>
                                <td><?php echo htmlspecialchars($package['destination']); ?></td>
                                <td>INR <?php echo number_format($package['price'], 2); ?></td>
                                <td><?php echo htmlspecialchars($package['duration']); ?></td>
                                <td><?php echo date('M d, Y', strtotime($package['created_at'])); ?></td>
                                <td>
                                    <span class="status-badge <?php echo $package['is_active'] ? 'confirmed' : 'cancelled'; ?>">
                                        <?php echo $package['is_active'] ? 'Active' : 'Inactive'; ?>
                                    </span>
                                </td>
                                <td class="action-buttons">
                                    <a href="../package-details.html?id=<?php echo $package['id']; ?>" class="btn-view" target="_blank">View</a>
                                    <a href="packages.php?edit=<?php echo $package['id']; ?>" class="btn-edit">Edit</a>
                                    <a href="packages.php?delete=<?php echo $package['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        .success-message {
            background: #e6f4ea;
            color: var(--secondary);
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .error-message {
            background: #fce8e6;
            color: #ea4335;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
    </style>
</body>
</html>