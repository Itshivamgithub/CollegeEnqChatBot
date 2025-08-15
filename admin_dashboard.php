<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.html");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --primary-bg: #222831;
            --secondary-bg: #31363F;
            --accent: #9b59b6; /* Different color for admin */
            --text: #EEEEEE;
        }

        /* Use same styles as user dashboard */
        body { font-family: 'Poppins', sans-serif; margin: 0; background: var(--primary-bg); color: var(--text); display: flex; min-height: 100vh; }
        .sidebar { width: 280px; background: var(--secondary-bg); padding: 30px 20px; position: fixed; height: 100%; box-shadow: 4px 0 15px rgba(0,0,0,0.2); }
        .brand { font-size: 24px; font-weight: 600; color: var(--accent); margin-bottom: 40px; padding-left: 15px; }
        .nav-menu { list-style: none; padding: 0; margin: 0; }
        .nav-item { margin: 12px 0; transition: all 0.3s ease; }
        .nav-item a { color: var(--text); text-decoration: none; padding: 15px 20px; border-radius: 8px; display: flex; align-items: center; gap: 12px; font-size: 16px; }
        .nav-item a:hover, .nav-item.active a { background: var(--accent); transform: translateX(10px); }
        .main-content { margin-left: 280px; flex: 1; padding: 40px; }
        .content-frame { width: 100%; height: calc(100vh - 80px); border: none; border-radius: 15px; background: var(--secondary-bg); box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .logout-btn { position: fixed; top: 30px; right: 40px; background: var(--accent); color: white; padding: 12px 25px; border: none; border-radius: 8px; cursor: pointer; display: flex; align-items: center; gap: 8px; transition: transform 0.2s; }
        .logout-btn:hover { transform: translateY(-2px); }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="brand">Admin Panel</div>
        <ul class="nav-menu">
            <li class="nav-item active"><a href="admin_entries.php" target="content-frame"><i class="fas fa-users"></i> User Entries</a></li>
            <li class="nav-item"><a href="admin_feedback.php" target="content-frame"><i class="fas fa-comments"></i> Feedback</a></li>
        </ul>
    </div>

    <div class="main-content">
        <button class="logout-btn" onclick="window.location.href='admin_logout.php'">
            <i class="fas fa-sign-out-alt"></i>
            Logout
        </button>
        <iframe name="content-frame" class="content-frame" src="admin_entries.php"></iframe>
    </div>
</body>
</html>