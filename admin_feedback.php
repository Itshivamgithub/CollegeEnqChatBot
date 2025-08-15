<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.html");
    exit();
}

$conn = new mysqli("localhost", "root", "", "auth_demo");
$result = $conn->query("
    SELECT feedback.*, users.username 
    FROM feedback 
    JOIN users ON feedback.user_id = users.id 
    ORDER BY feedback.created_at DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Feedback Management</title>
    <style>
        .feedback-table {
            width: 100%;
            border-collapse: collapse;
            background: #31363F;
            color: #EEEEEE;
        }
        .feedback-table th {
            background: #8296d0;
            padding: 15px;
            text-align: left;
        }
        .feedback-table td {
            padding: 12px;
            border-bottom: 1px solid #40444E;
        }
        .feedback-message {
            max-width: 400px;
            white-space: pre-wrap;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>User Feedback</h2>
        <table class="feedback-table">
            <tr>
                <th>User</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Date</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td><?= htmlspecialchars($row['subject']) ?></td>
                    <td class="feedback-message"><?= htmlspecialchars($row['message']) ?></td>
                    <td><?= date('M j, Y g:i A', strtotime($row['created_at'])) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>