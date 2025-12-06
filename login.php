<?php
session_start();

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: cmsPanel.php");
    exit;
}

$error = '';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // credentials
    if ($username === 'jakesAdmin' && $password === '123') {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        header("Location: cmsPanel.php");
        exit;
    } else {
        $error = 'Invalid username or password!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jake's Coffee Shop - Admin Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5dc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            max-width: 450px;
            width: 100%;
            background-color: white;
            border: 3px solid #4a2c2a;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
            overflow: hidden;
        }

        .login-header {
            background-color: #c9a961;
            padding: 40px 30px;
            text-align: center;
            border-bottom: 3px solid #4a2c2a;
        }

        .login-header h1 {
            color: #4a2c2a;
            font-size: 2em;
            margin-bottom: 10px;
        }

        .login-header p {
            color: #4a2c2a;
            font-size: 1em;
            font-style: italic;
        }

        .coffee-icon {
            font-size: 3em;
            margin-bottom: 10px;
        }

        .login-body {
            padding: 40px 30px;
            background-color: #f5f5dc;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            color: #4a2c2a;
            font-weight: bold;
            margin-bottom: 8px;
            font-size: 1em;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #c9a961;
            border-radius: 5px;
            font-size: 1em;
            font-family: Arial, sans-serif;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #4a2c2a;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 12px;
            border: 2px solid #f5c6cb;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }

        .btn-login {
            width: 100%;
            padding: 15px;
            background-color: #4a2c2a;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1.1em;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-login:hover {
            background-color: #6b4423;
        }

        .login-footer {
            background-color: #c9a961;
            padding: 20px;
            text-align: center;
            border-top: 3px solid #4a2c2a;
        }

        .login-footer p {
            color: #4a2c2a;
            margin-bottom: 5px;
            font-size: 0.9em;
        }

        .login-footer a {
            color: #4a2c2a;
            text-decoration: none;
            font-weight: bold;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            color: #4a2c2a;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }

        .back-link a:hover {
            color: #6b4423;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-header h1 {
                font-size: 1.5em;
            }

            .coffee-icon {
                font-size: 2.5em;
            }

            .login-body {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-header">
        <div class="coffee-icon">☕</div>
        <h1>Jake's Coffee Shop</h1>
        <p>Administration Login</p>
    </div>

    <div class="login-body">
        <?php if ($error): ?>
            <div class="error-message">
                ⚠️ <?= $error ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter username" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter password" required>
            </div>

            <button type="submit" name="login" class="btn-login">
                🔐 Login to Admin Panel
            </button>
        </form>

        <div class="back-link">
            <a href="jakesCoffeesShop.php">← Back to Website</a>
        </div>
    </div>

    <div class="login-footer">
        <p>Copyright © 2011 Jake's Coffee House</p>
        <a href="mailto:jake@jcoffee.com">jake@jcoffee.com</a>
    </div>
</div>

</body>
</html>