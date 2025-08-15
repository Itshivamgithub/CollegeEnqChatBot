<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "auth_demo";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// File upload directory
$upload_dir = "uploads/";
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

// Initialize messages
$success = '';
$error = '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $user_id = $_SESSION['user_id'];
        
        // Profile Picture Upload
        if (!empty($_FILES['profile_pic']['name'])) {
            $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
            $file_ext = strtolower(pathinfo($_FILES['profile_pic']['name'], PATHINFO_EXTENSION));
            
            if (!in_array($file_ext, $allowed_types)) {
                throw new Exception("Only JPG, JPEG, PNG & GIF files are allowed");
            }
            
            $new_filename = "user_{$user_id}_" . time() . ".{$file_ext}";
            $target_file = $upload_dir . $new_filename;
            
            if (!move_uploaded_file($_FILES['profile_pic']['tmp_name'], $target_file)) {
                throw new Exception("Failed to upload image");
            }
            
            $stmt = $conn->prepare("UPDATE users SET profile_pic = ? WHERE id = ?");
            $stmt->bind_param("si", $target_file, $user_id);
            $stmt->execute();
            $success .= 'Profile picture updated! ';
        }

        // Profile Information Update
        if (isset($_POST['update_profile'])) {
            $username = $conn->real_escape_string($_POST['username']);
            $email = $conn->real_escape_string($_POST['email']);
            $phone = $conn->real_escape_string($_POST['phone']);
            
            $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, phone = ? WHERE id = ?");
            $stmt->bind_param("sssi", $username, $email, $phone, $user_id);
            
            if (!$stmt->execute()) {
                throw new Exception("Profile update failed: " . $stmt->error);
            }
            $success .= 'Profile information updated! ';
        }

        // Password Change
        if (isset($_POST['change_password'])) {
            $old_password = $_POST['old_password'];
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];
            
            if ($new_password !== $confirm_password) {
                throw new Exception("New passwords do not match");
            }
            
            $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            
            if (!password_verify($old_password, $user['password'])) {
                throw new Exception("Old password is incorrect");
            }
            
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
            $stmt->bind_param("si", $hashed_password, $user_id);
            $stmt->execute();
            $success .= 'Password changed successfully! ';
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

// Get current user data
$user_id = $_SESSION['user_id'];
$user = $conn->query("SELECT * FROM users WHERE id = $user_id")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --primary-bg: #222831;
            --secondary-bg: #31363F;
            --accent: #8296d0;
            --text: #EEEEEE;
            --border: #40444E;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--primary-bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .profile-container {
            background: var(--secondary-bg);
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 800px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 30px;
            margin-bottom: 40px;
        }

        .avatar-wrapper {
            position: relative;
        }

        .profile-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--accent);
            transition: 0.3s;
        }

        .avatar-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.5);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: 0.3s;
            cursor: pointer;
        }

        .avatar-wrapper:hover .avatar-overlay {
            opacity: 1;
        }

        .avatar-overlay i {
            font-size: 1.5rem;
            color: white;
        }

        .user-meta h1 {
            color: var(--accent);
            margin-bottom: 5px;
        }

        .user-meta p {
            opacity: 0.8;
        }

        .form-section {
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: var(--accent);
            font-weight: 500;
        }

        input {
            width: 100%;
            padding: 14px;
            background: var(--primary-bg);
            border: 2px solid var(--border);
            border-radius: 10px;
            color: var(--text);
            font-size: 16px;
            transition: border-color 0.3s;
        }

        input:focus {
            border-color: var(--accent);
            outline: none;
        }

        .btn {
            background: var(--accent);
            color: white;
            padding: 14px 30px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            transition: transform 0.2s, box-shadow 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn i {
            font-size: 1.1rem;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(130, 150, 208, 0.4);
        }

        .alert {
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
        }

        .alert-success {
            background: rgba(46, 204, 113, 0.15);
            color: #2ecc71;
            border: 1px solid #2ecc7050;
        }

        .alert-error {
            background: rgba(231, 76, 60, 0.15);
            color: #e74c3c;
            border: 1px solid #e74c3c50;
        }

        .password-section {
            border-top: 2px solid var(--border);
            padding-top: 30px;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <?php if ($success): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="alert alert-error"><?= $error ?></div>
        <?php endif; ?>

        <div class="profile-header">
            <div class="avatar-wrapper">
                <img src="<?= $user['profile_pic'] ?? 'assets/default-avatar.png' ?>" 
                     class="profile-avatar" 
                     alt="Profile Picture">
                <form method="POST" enctype="multipart/form-data" class="avatar-overlay">
                    <label>
                        <i class="fas fa-camera"></i>
                        <input type="file" 
                               name="profile_pic" 
                               accept="image/*"
                               onchange="this.form.submit()"
                               style="display: none;">
                    </label>
                </form>
            </div>
            <div class="user-meta">
                <h1><?= htmlspecialchars($user['username']) ?></h1>
                <p><?= htmlspecialchars($user['email']) ?></p>
            </div>
        </div>

        <form method="POST">
            <div class="form-section">
                <h2 style="color: var(--accent); margin-bottom: 20px;">Profile Information</h2>
                
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" 
                           name="username" 
                           value="<?= htmlspecialchars($user['username']) ?>"
                           required>
                </div>

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" 
                           name="email" 
                           value="<?= htmlspecialchars($user['email']) ?>"
                           required>
                </div>

                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" 
                           name="phone" 
                           value="<?= htmlspecialchars($user['phone'] ?? '') ?>">
                </div>

                <button type="submit" name="update_profile" class="btn">
                    <i class="fas fa-save"></i>
                    Save Changes
                </button>
            </div>

            <div class="password-section">
                <h2 style="color: var(--accent); margin-bottom: 20px;">Change Password</h2>
                
                <div class="form-group">
                    <label>Old Password</label>
                    <input type="password" name="old_password" required>
                </div>

                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="new_password" required>
                </div>

                <div class="form-group">
                    <label>Confirm New Password</label>
                    <input type="password" name="confirm_password" required>
                </div>

                <button type="submit" name="change_password" class="btn">
                    <i class="fas fa-lock"></i>
                    Change Password
                </button>
            </div>
        </form>
    </div>
</body>
</html>