<?php
session_start();
require_once '../php/config.php';

// Check if user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: ../admin-login.php');
    exit;
}

// Get admin user info
$admin_username = $_SESSION['admin_username'];
$admin_email = $_SESSION['admin_email'];

// Get statistics
$pdo = getDBConnection();

// Total packages
$stmt = $pdo->query("SELECT COUNT(*) as total FROM packages");
$total_packages = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

// Total bookings
$stmt = $pdo->query("SELECT COUNT(*) as total FROM bookings");
$total_bookings = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

// Pending enquiries
$stmt = $pdo->query("SELECT COUNT(*) as total FROM enquiries WHERE status = 'new'");
$pending_enquiries = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

// Recent bookings
$stmt = $pdo->query("SELECT b.*, p.title as package_name 
                     FROM bookings b 
                     LEFT JOIN packages p ON b.package_id = p.id 
                     ORDER BY b.created_at DESC 
                     LIMIT 5");
$recent_bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Recent packages
$stmt = $pdo->query("SELECT * FROM packages ORDER BY created_at DESC LIMIT 5");
$recent_packages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Avipro Travels</title>
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
                    <li><a href="admin-panel.php" class="active">Dashboard</a></li>
                    <li><a href="packages.php">Travel Packages</a></li>
                    <li><a href="bookings.html">Bookings</a></li>
                    <li><a href="enquiries.php">Enquiries</a></li>
                </ul>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="admin-content">
            <div class="admin-header">
                <h1>Dashboard</h1>
                <div class="admin-user">
                    Welcome, <?php echo htmlspecialchars($admin_username); ?> | 
                    <a href="../php/logout.php">Logout</a>
                </div>
            </div>
            
            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card primary">
                    <div class="stat-number"><?php echo $total_packages; ?></div>
                    <div class="stat-label">Total Packages</div>
                </div>
                <div class="stat-card success">
                    <div class="stat-number"><?php echo $total_bookings; ?></div>
                    <div class="stat-label">Total Bookings</div>
                </div>
                <div class="stat-card warning">
                    <div class="stat-number"><?php echo $pending_enquiries; ?></div>
                    <div class="stat-label">Pending Enquiries</div>
                </div>
                <div class="stat-card danger">
                    <div class="stat-number">INR 6,49,977</div>
                    <div class="stat-label">Total Revenue</div>
                </div>
            </div>
            
            <!-- Recent Bookings -->
            <div class="admin-card">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <h3>Recent Bookings</h3>
                    <a href="bookings.html" class="btn">View All</a>
                </div>
                
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Customer</th>
                                <th>Package</th>
                                <th>Travel Date</th>
                                <th>Persons</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recent_bookings as $booking): ?>
                            <tr>
                                <td>#BK<?php echo str_pad($booking['id'], 3, '0', STR_PAD_LEFT); ?></td>
                                <td>
                                    <strong><?php echo htmlspecialchars($booking['name']); ?></strong><br>
                                    <?php echo htmlspecialchars($booking['email']); ?>
                                </td>
                                <td><?php echo htmlspecialchars($booking['package_name'] ?? 'N/A'); ?></td>
                                <td><?php echo date('d M Y', strtotime($booking['travel_date'])); ?></td>
                                <td><?php echo $booking['persons']; ?></td>
                                <td>
                                    <span class="status-badge <?php echo $booking['status']; ?>">
                                        <?php echo ucfirst($booking['status']); ?>
                                    </span>
                                </td>
                                <td class="action-buttons">
                                    <a href="booking-details.php?id=<?php echo $booking['id']; ?>" class="btn-view">View</a>
                                    <a href="bookings.php?edit=<?php echo $booking['id']; ?>" class="btn-edit">Edit</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Recent Packages -->
            <div class="admin-card">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <h3>Recent Packages</h3>
                    <a href="packages.php" class="btn">Manage Packages</a>
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
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recent_packages as $package): ?>
                            <tr>
                                <td>#PKG<?php echo str_pad($package['id'], 3, '0', STR_PAD_LEFT); ?></td>
                                <td><?php echo htmlspecialchars($package['title']); ?></td>
                                <td><?php echo htmlspecialchars($package['destination']); ?></td>
                                <td>₹<?php echo number_format($package['price'], 2); ?></td>
                                <td><?php echo htmlspecialchars($package['duration']); ?></td>
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
        .status-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        .status-badge.confirmed {
            background: #e6f4ea;
            color: var(--secondary);
        }
        .status-badge.pending {
            background: #fef7e0;
            color: var(--accent);
        }
        .status-badge.cancelled {
            background: #fce8e6;
            color: #ea4335;
        }
    </style>
</body>
</html>