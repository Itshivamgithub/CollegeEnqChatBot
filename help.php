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
    <title>Help & Support</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --primary-bg: #1a1d24;    /* Darker background */
            --secondary-bg: #2d313a;  /* Medium contrast */
            --accent: #8fa3dd;        /* Brighter blue */
            --text: #ffffff;          /* Pure white text */
            --highlight: #a6b7ee;    /* Light accent */
        }

        body {
            background: var(--primary-bg);
            color: var(--text);
        }

        .help-container {
            display: flex;
            gap: 30px;
            padding: 40px;
            min-height: 80vh;
        }

        .contact-info {
            background: var(--secondary-bg);
            border-radius: 15px;
            padding: 30px;
            width: 320px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .support-chat {
            flex: 1;
            background: var(--secondary-bg);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .contact-item {
            margin: 25px 0;
            padding: 20px;
            background: var(--primary-bg);
            border-radius: 12px;
            border: 1px solid #3d424b;
            transition: transform 0.3s;
        }

        .contact-item:hover {
            transform: translateX(10px);
            border-color: var(--accent);
        }

        .contact-item i {
            color: var(--highlight);
            margin-right: 15px;
            font-size: 1.4em;
        }

        .contact-item h3 {
            color: var(--highlight);
            margin: 0 0 8px 0;
            font-size: 1.2em;
        }

        .contact-item p {
            color: var(--text);
            margin: 0;
            font-size: 1em;
            opacity: 0.9;
        }

        .chat-message {
            background: var(--primary-bg);
            padding: 20px;
            border-radius: 12px;
            margin: 20px 0;
            border-left: 4px solid var(--accent);
        }

        .chat-message p {
            margin: 0;
            line-height: 1.6;
        }

        h2 {
            color: var(--highlight) !important;
            margin-bottom: 30px;
            font-size: 1.8em;
            border-bottom: 2px solid var(--accent);
            padding-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="help-container">
        <!-- Left Side: Contact Info -->
        <div class="contact-info">
            <h2>Developer Contact</h2>
            
            <div class="contact-item">
                <i class="fas fa-user"></i>
                <div>
                    <h3> akash paswan
                    
                    </h3>
                    <p>Lead Developer</p>
                </div>
            </div>

            <div class="contact-item">
                <i class="fas fa-envelope"></i>
                <div>
                    <h3>Email Support</h3>
                    <p>support@collegeportal.com</p>
                </div>
            </div>

            <div class="contact-item">
                <i class="fas fa-phone"></i>
                <div>
                    <h3>24/7 Helpline</h3>
                    <p>+91 12345 67890</p>
                </div>
            </div>
        </div>

        <!-- Right Side: Support Chat -->
        <div class="support-chat">
            <h2>Quick Assistance</h2>
            
            <div class="chat-message">
                <p>📧 <strong>Email Support:</strong><br>
                help@collegeportal.com<br>
                <small>Response within 24 hours</small></p>
            </div>

            <div class="chat-message">
                <p>📞 <strong>Phone Support:</strong><br>
                +91 98765 43210<br>
                <small>Mon-Sat: 9AM - 6PM</small></p>
            </div>

            <div class="chat-message">
                <p>🛠️ <strong>Technical Issues:</strong><br>
                techsupport@collegeportal.com<br>
                <small>Include screenshots if possible</small></p>
            </div>
        </div>
    </div>
</body>
</html>