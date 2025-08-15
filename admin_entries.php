<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.html");
    exit();
}

$conn = new mysqli("localhost", "root", "", "auth_demo");
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        :root {
            --primary-bg: #222831;
            --secondary-bg: #31363F;
            --accent: #9b59b6;
            --text: #f0f0f0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 20px;
            background: var(--primary-bg);
            color: var(--text);
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
            background: var(--secondary-bg);
            border-radius: 10px;
            overflow: hidden;
        }

        .admin-table th {
            background: var(--accent);
            padding: 15px;
            text-align: left;
            color: white;
        }

        .admin-table td {
            padding: 12px;
            border-bottom: 1px solid #40444E;
            color: #d1d1d1 !important;
        }

        .user-count {
            color: var(--accent);
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="user-count">
        Total Users: <?php echo $conn->query("SELECT COUNT(*) FROM users")->fetch_row()[0]; ?>
    </div>
    
    <table class="admin-table">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Joined Date</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM users ORDER BY created_at DESC");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['username']}</td>
                <td>{$row['email']}</td>
                <td>" . date('M j, Y', strtotime($row['created_at'])) . "</td>
            </tr>";
        }
        ?>
    </table>
</body>
</html>