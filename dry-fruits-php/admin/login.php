<?php
// Bootstrap application
require_once __DIR__ . '/../config/autoload.php';

// Start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Get environment variables
$env = require_once __DIR__ . '/../config/env.php';

// Check if already logged in as admin
$user = new App\User();
if ($user->isAdmin()) {
    header('Location: index.php');
    exit;
}

// Process login form
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    
    // Basic validation
    if (empty($email) || empty($password)) {
        $error = 'Please enter both email and password.';
    } else {
        // Try to authenticate
        if ($user->authenticate($email, $password)) {
            // Check if user is admin
            if ($user->isAdmin()) {
                // Successful login, redirect to admin dashboard
                header('Location: index.php');
                exit;
            } else {
                // Not an admin user
                $error = 'You do not have permission to access the admin area.';
                $user->logout(); // Log them out
            }
        } else {
            $error = 'Invalid email or password.';
        }
    }
}

// Check if we need to create the admin user
if (isset($_GET['setup']) && $_GET['setup'] === 'admin') {
    $result = $user->createAdminUser();
    if ($result) {
        $success = 'Admin user created successfully! You can now login.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - <?php echo $env['site_name']; ?></title>
    
    <!-- Favicon -->
    <link rel="icon" href="/assets/images/favicon.png" type="image/png">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Admin CSS -->
    <link rel="stylesheet" href="assets/css/admin.css">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        
        .login-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
            animation: fadeIn 0.5s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .login-header {
            background-color: #4CAF50;
            color: #fff;
            padding: 30px;
            text-align: center;
        }
        
        .login-header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        
        .login-body {
            padding: 30px;
        }
        
        .form-floating {
            margin-bottom: 20px;
        }
        
        .form-control:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 0 0.25rem rgba(76, 175, 80, 0.25);
        }
        
        .btn-primary {
            background-color: #4CAF50;
            border-color: #4CAF50;
            padding: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: #3e8e41;
            border-color: #3e8e41;
            transform: translateY(-2px);
        }
        
        .error-message {
            color: #dc3545;
            margin-bottom: 15px;
            font-size: 14px;
            animation: shake 0.5s ease-in-out;
        }
        
        .success-message {
            color: #28a745;
            margin-bottom: 15px;
            font-size: 14px;
        }
        
        @keyframes shake {
            0%, 100% {transform: translateX(0);}
            10%, 30%, 50%, 70%, 90% {transform: translateX(-5px);}
            20%, 40%, 60%, 80% {transform: translateX(5px);}
        }
        
        .back-to-site {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #6c757d;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .back-to-site:hover {
            color: #4CAF50;
        }
        
        .login-footer {
            text-align: center;
            padding: 0 30px 30px;
            color: #6c757d;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Admin Login</h1>
        </div>
        
        <div class="login-body">
            <?php if (!empty($error)): ?>
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($success)): ?>
                <div class="success-message">
                    <i class="fas fa-check-circle"></i> <?php echo $success; ?>
                </div>
            <?php endif; ?>
            
            <form action="login.php" method="POST">
                <div class="form-floating">
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                    <label for="email">Email address</label>
                </div>
                
                <div class="form-floating">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    <label for="password">Password</label>
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </button>
                </div>
            </form>
            
            <a href="/" class="back-to-site">
                <i class="fas fa-arrow-left"></i> Back to Website
            </a>
        </div>
        
        <div class="login-footer">
            <p>&copy; <?php echo date('Y'); ?> <?php echo $env['site_name']; ?>. All Rights Reserved.</p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 