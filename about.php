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
    <title>About Project</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --primary-bg: #222831;
            --secondary-bg: #31363F;
            --accent: #8296d0;
            --text: #EEEEEE;
        }

        .about-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 30px;
            background: var(--secondary-bg);
            border-radius: 15px;
        }

        .project-title {
            color: var(--accent);
            text-align: center;
            margin-bottom: 30px;
            font-size: 2.2em;
        }

        .tech-section {
            margin-bottom: 35px;
        }

        .tech-heading {
            color: var(--accent);
            font-size: 1.4em;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .tech-list {
            list-style: none;
            padding-left: 20px;
        }

        .tech-item {
            color: var(--text);
            margin: 12px 0;
            padding: 15px;
            background: var(--primary-bg);
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .tech-icon {
            color: var(--accent);
            font-size: 1.2em;
            width: 25px;
        }

        .key-features {
            border-top: 2px solid var(--accent);
            padding-top: 30px;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="about-container">
        <h1 class="project-title">College Enquiry Chatbot System</h1>
        
        <div class="tech-section">
            <h2 class="tech-heading">
                <i class="fas fa-code"></i>
                Technologies Used
            </h2>
            
            <div class="tech-section">
                <h3 class="tech-heading">
                    <i class="fas fa-palette"></i>
                    Frontend
                </h3>
                <ul class="tech-list">
                    <li class="tech-item">
                        <i class="tech-icon fas fa-file-code"></i>
                        HTML5 - Page structure and content
                    </li>
                    <li class="tech-item">
                        <i class="tech-icon fab fa-css3-alt"></i>
                        CSS3 - Styling and animations
                    </li>
                    <li class="tech-item">
                        <i class="tech-icon fab fa-js"></i>
                        JavaScript - Chatbot interactions
                    </li>
                </ul>
            </div>

            <div class="tech-section">
                <h3 class="tech-heading">
                    <i class="fas fa-server"></i>
                    Backend
                </h3>
                <ul class="tech-list">
                    <li class="tech-item">
                        <i class="tech-icon fab fa-php"></i>
                        PHP 8.x - Server-side logic
                    </li>
                    <li class="tech-item">
                        <i class="tech-icon fas fa-database"></i>
                        MySQL - Data storage and management
                    </li>
                </ul>
            </div>
        </div>

        <div class="key-features">
            <h2 class="tech-heading">
                <i class="fas fa-star"></i>
                Key Features
            </h2>
            <ul class="tech-list">
                <li class="tech-item">
                    <i class="tech-icon fas fa-comments"></i>
                    AI-Powered Chatbot for instant queries
                </li>
                <li class="tech-item">
                    <i class="tech-icon fas fa-shield-alt"></i>
                    Secure user authentication system
                </li>
                <li class="tech-item">
                    <i class="tech-icon fas fa-mobile-alt"></i>
                    Fully responsive design
                </li>
                <li class="tech-item">
                    <i class="tech-icon fas fa-database"></i>
                    Real-time database integration
                </li>
            </ul>
        </div>
    </div>
</body>
</html>