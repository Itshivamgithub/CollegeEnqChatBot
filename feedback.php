<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

// Database connection and processing code from previous implementation
?>

<!DOCTYPE html>
<html>
<head>
    <title>Feedback</title>
    <style>
        .feedback-container {
            max-width: 700px;
            margin: 0 auto;
            padding: 40px;
        }

        .feedback-box {
            background: var(--secondary-bg);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        h2 {
            color: var(--accent);
            margin-bottom: 30px;
            font-size: 28px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        input, textarea {
            width: 100%;
            padding: 14px;
            background: var(--primary-bg);
            border: 2px solid #3a3f49;
            border-radius: 8px;
            color: var(--text);
            font-family: 'Poppins', sans-serif;
            transition: border-color 0.3s;
        }

        input:focus, 
        textarea:focus {
            border-color: var(--accent);
            outline: none;
        }

        button[type="submit"] {
            background: var(--accent);
            color: white;
            padding: 14px 35px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: transform 0.2s;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        button[type="submit"]:hover {
            transform: translateY(-2px);
        }

        .status-message {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 25px;
            display: none;
        }

        .success {
            background: #2ecc71;
            display: block;
        }

        .error {
            background: #e74c3c;
            display: block;
        }
    </style>
</head>
<body>
    <div class="feedback-container">
        <div class="feedback-box">
            <h2><i class="fas fa-comment-dots"></i> Submit Feedback</h2>
            
            <?php if(isset($success)): ?>
                <div class="status-message success">
                    <?php echo $success; ?>
                </div>
            <?php endif; ?>
            
            <?php if(isset($error)): ?>
                <div class="status-message error">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <input type="text" name="subject" placeholder="Feedback Subject" required>
                </div>
                
                <div class="form-group">
                    <textarea name="message" rows="6" placeholder="Write your feedback here..." required></textarea>
                </div>

                <button type="submit">
                    <i class="fas fa-paper-plane"></i>
                    Send Feedback
                </button>
            </form>
        </div>
    </div>
</body>
</html>