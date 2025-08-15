<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --primary-bg: #222831;
            --secondary-bg: #31363F;
            --accent: #8296d0;
            --text: #EEEEEE;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background: var(--primary-bg);
            color: var(--text);
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: var(--secondary-bg);
            padding: 30px 20px;
            position: fixed;
            height: 100%;
            box-shadow: 4px 0 15px rgba(0,0,0,0.2);
        }

        .brand {
            font-size: 24px;
            font-weight: 600;
            color: var(--accent);
            margin-bottom: 40px;
            padding-left: 15px;
        }

        .nav-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-item {
            margin: 12px 0;
            transition: all 0.3s ease;
        }

        .nav-item a {
            color: var(--text);
            text-decoration: none;
            padding: 15px 20px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 16px;
        }

        .nav-item a:hover,
        .nav-item.active a {
            background: var(--accent);
            transform: translateX(10px);
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            flex: 1;
            padding: 40px;
        }

        .content-frame {
            width: 100%;
            height: calc(100vh - 80px);
            border: none;
            border-radius: 15px;
            background: var(--secondary-bg);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .logout-btn {
            position: fixed;
            top: 30px;
            right: 40px;
            background: var(--accent);
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: transform 0.2s;
        }

        .logout-btn:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="brand">College Portal</div>
        <ul class="nav-menu">
            <li class="nav-item active"><a href="home.php" target="content-frame"><i class="fas fa-home"></i> Home</a></li>
            <li class="nav-item"><a href="profile.php" target="content-frame"><i class="fas fa-user"></i> Profile</a></li>
            <li class="nav-item"><a href="about.php" target="content-frame"><i class="fas fa-info-circle"></i> About</a></li>
            <li class="nav-item"><a href="chatbot/index.html" target="content-frame"><i class="fas fa-robot"></i> Chat Assistant</a></li>
            <li class="nav-item"><a href="feedback.php" target="content-frame"><i class="fas fa-comment-dots"></i> Feedback</a></li>
            <li class="nav-item"><a href="help.php" target="content-frame"><i class="fas fa-question-circle"></i> Help</a></li>
        </ul>
    </div>

    <div class="main-content">
        <button class="logout-btn" onclick="window.location.href='logout.php'">
            <i class="fas fa-sign-out-alt"></i>
            Logout
        </button>
        <iframe name="content-frame" class="content-frame" src="home.php"></iframe>
    </div>
</body>
</html>