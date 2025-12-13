<?php
session_start();
require_once 'php/config.php';

// Check if already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: admin/admin-panel.php');
    exit;
}

// Handle login form submission
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (!empty($username) && !empty($password)) {
        // For demo purposes - hardcoded credentials
        if ($username === 'admin' && $password === 'admin123') {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = 1;
            $_SESSION['admin_username'] = 'admin';
            $_SESSION['admin_email'] = 'admin@aviprotravels.com';
            
            header('Location: admin/admin-panel.php');
            exit;
        } else {
            // Try database authentication as fallback
            try {
                $pdo = getDBConnection();
                $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = ?");
                $stmt->execute([$username]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($user) {
                    // Check if password is hashed
                    if (password_verify($password, $user['password_hash'])) {
                        $_SESSION['admin_logged_in'] = true;
                        $_SESSION['admin_id'] = $user['id'];
                        $_SESSION['admin_username'] = $user['username'];
                        $_SESSION['admin_email'] = $user['email'];
                        
                        header('Location: admin/admin-panel.php');
                        exit;
                    } else {
                        $error = 'Invalid username or password!';
                    }
                } else {
                    $error = 'Invalid username or password!';
                }
            } catch (Exception $e) {
                // If database fails, use hardcoded credentials
                if ($username === 'admin' && $password === 'admin123') {
                    $_SESSION['admin_logged_in'] = true;
                    $_SESSION['admin_id'] = 1;
                    $_SESSION['admin_username'] = 'admin';
                    $_SESSION['admin_email'] = 'admin@aviprotravels.com';
                    
                    header('Location: admin/admin-panel.php');
                    exit;
                } else {
                    $error = 'Invalid username or password!';
                }
            }
        }
    } else {
        $error = 'Please enter both username and password!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Avipro Travels</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin.css">
    <style>
        /* Additional styles for login page */
        body {
            min-height: 90vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .logo span {
            color: #34a853;
        }
        .btn {
            background: blue;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
        }       
        .error-message {
            background: #ffebee;
            color: #c62828;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;

        }     
        .demo-credentials {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-form">
            <div class="logo">
                <h1>&nbsp &nbsp &nbsp &nbsp Avipro<span>Yatra</span></h1>
            </div>
            
            <h2>Login to Admin Panel</h2>
            
            <?php if (!empty($error)): ?>
                <div class="error-message">
                    <strong>Error:</strong> <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control" 
                           required 
                           placeholder="Enter your username"
                           value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" 
                           required 
                           placeholder="Enter your password">
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
            
            <div style="text-align: center; margin-top: 25px;">
                <a href="index.html" class="back-link">← Back to Main Website</a>
            </div>
            
            <!-- Demo Credentials -->
            <div class="demo-credentials">
                <strong>Demo Credentials:</strong>
                <div style="margin-top: 5px;">
                    <span style="color: #666;">Username:</span> <code>admin</code><br>
                    <span style="color: #666;">Password:</span> <code>admin123</code>
                </div>
            </div>
        </div>
    </div>
</body>
</html>