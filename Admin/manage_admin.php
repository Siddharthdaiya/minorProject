<?php
session_start();
include 'config.php';

// Check if the user is logged in as admin
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: login.php");
    exit();
}

// Handle Add Admin
if (isset($_POST['add_admin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash password for security

    $stmt = $conn->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashed_password);
    if ($stmt->execute()) {
        $message = "Admin added successfully!";
    } else {
        $error = "Error: " . $stmt->error;
    }
}

// Handle Delete Admin
if (isset($_GET['delete'])) {
    $admin_id = $_GET['delete'];

    $stmt = $conn->prepare("DELETE FROM admins WHERE id = ?");
    $stmt->bind_param("i", $admin_id);
    if ($stmt->execute()) {
        $message = "Admin deleted successfully!";
    } else {
        $error = "Error: " . $stmt->error;
    }
}

// Fetch all admins
$admins = $conn->query("SELECT * FROM admins");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Admins</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        /* Dashboard Container */
        .dashboard {
            display: flex;
        }

        /* Sidebar */
        aside {
            width: 250px;
            height: 100vh;
            background-color: #333;
            padding: 20px;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
        }

        /* Sidebar Links */
        aside ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        aside ul li {
            margin-bottom: 20px;
        }

        aside ul li a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            padding: 10px;
            display: block;
            background-color: #444;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        aside ul li a:hover {
            background-color: #f39c12;
        }

        /* Main Content Area */
        .container {
            margin-left: 300px;
            padding: 40px;
            flex: 1; /* Ensure the container takes up the remaining space */
        }

        /* Headings */
        h1 {
            color: #333;
        }

        /* Alerts */
        .message, .error {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .message {
            background-color: #d4edda;
            color: #155724;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
        }

        /* Form Elements */
        form input, form button {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box; /* Ensure padding and border are included in the total width */
        }

        form button {
            background-color: #f39c12;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }

        form button:hover {
            background-color: #e67e22;
            transform: scale(1.05);
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* Links */
        a {
            text-decoration: none;
            transition: color 0.3s;
        }

        .edit-link {
            color: #27ae60;
            font-weight: bold;
            margin-right: 10px;
        }

        .edit-link:hover {
            color: #2ecc71;
        }

        .delete-link {
            color: #e74c3c;
            font-weight: bold;
        }

        .delete-link:hover {
            color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <aside>
            <h2>Admin Panel</h2>
            <ul>
            <li><a href="manage_user.php">Manage Users</a></li>
                <li><a href="dashboard.php">DashBoard</a></li>
                <li><a href="manage_propt.php">Manage Properties</a></li>
                <li><a href="reports.php">Reports</a></li>
                <li><a href="manage_admin.php">Manage Admins</a></li>
                <li><a href="rent_propt.php">Rent property</a></li>
                <li><a href="manage_rent.php">Manage Rental Property</a></li>
                <li><a href="settings.php">Settings</a></li>
            </ul>
        </aside>
        <div class="container">
            <h1>Manage Admins</h1>

            <?php if (isset($message)): ?>
                <div class="message"><?php echo $message; ?></div>
            <?php endif; ?>
            <?php if (isset($error)): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="post" action="manage_admin.php">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit" name="add_admin">Add Admin</button>
            </form>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>
                <?php while ($row = $admins->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td>
                            <a href="edit_admin.php?id=<?php echo $row['id']; ?>" class="edit-link">Edit</a>
                            <a href="admin_management.php?delete=<?php echo $row['id']; ?>" class="delete-link">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
</body>
</html>
