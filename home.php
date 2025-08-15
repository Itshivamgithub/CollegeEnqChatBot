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
    <style>
        .welcome-section {
            text-align: center;
            padding: 4rem 2rem;
            max-width: 800px;
            margin: 0 auto;
        }

        .greeting-main {
            color: #8296d0;
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            line-height: 1.3;
        }

        .greeting-sub {
            color: #EEEEEE;
            font-size: 1.2rem;
            opacity: 0.9;
            line-height: 1.6;
            max-width: 600px;
            margin: 0 auto;
        }

        .greeting-icon {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            color: #8296d0;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
            40% {transform: translateY(-30px);}
            60% {transform: translateY(-15px);}
        }
    </style>
</head>
<body>
    <div class="welcome-section">
        <i class="fas fa-hand-sparkles greeting-icon"></i>
        <h1 class="greeting-main">
            Welcome to the Colleague Enquiries Chatbot!
        </h1>
        <p class="greeting-sub">
            Get instant answers to your queries regarding college/office policies, 
            events, and more. Start chatting with our college assistant or explore 
            the dashboard features using the navigation menu.
        </p>
    </div>
</body>
</html>