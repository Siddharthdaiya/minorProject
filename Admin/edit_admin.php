<?php
session_start();
include 'config.php';

// Check if the user is logged in as admin
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: login.php");
    exit();
}

// Fetch admin ID from URL
if (isset($_GET['id'])) {
    $admin_id = intval($_GET['id']);

    // Fetch the admin details
    $stmt = $conn->prepare("SELECT * FROM admins WHERE id = ?");
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    if (!$admin) {
        header("Location: admin_management.php");
        exit();
    }
} else {
    header("Location: admin_management.php");
    exit();
}

// Handle Update Admin
if (isset($_POST['update_admin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL for updating admin
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE admins SET username = ?, password = ? WHERE id = ?");
        $stmt->bind_param("ssi", $username, $hashed_password, $admin_id);
    } else {
        // If password is not changed, do not update the password
        $stmt = $conn->prepare("UPDATE admins SET username = ? WHERE id = ?");
        $stmt->bind_param("si", $username, $admin_id);
    }

    if ($stmt->execute()) {
        $message = "Admin updated successfully!";
    } else {
        $error = "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin</title>
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
            flex: 1;
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
            box-sizing: border-box;
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
    </style>
</head>
<body>
    <div class="dashboard">
        <aside>
            <h2>Admin Panel</h2>
            <ul>
            <li><a href="manage_user.php">Manage Users</a></li>
                <li><a href="manage_propt.php">Manage Properties</a></li>
                <li><a href="reports.php">Reports</a></li>
                <li><a href="manage_admin.php">Manage Admins</a></li>
                <li><a href="rent_propt.php">Rent property</a></li>
                <li><a href="manage_rent.php">Manage Rental Property</a></li>
                <li><a href="settings.php">Settings</a></li>
            </ul>
        </aside>
        <div class="container">
            <h1>Edit Admin</h1>

            <?php if (isset($message)): ?>
                <div class="message"><?php echo $message; ?></div>
            <?php endif; ?>
            <?php if (isset($error)): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="post" action="edit_admin.php?id=<?php echo $admin_id; ?>">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($admin['username']); ?>" required>
                <label for="password">Password (leave blank if not changing):</label>
                <input type="password" id="password" name="password">
                <button type="submit" name="update_admin">Update Admin</button>
            </form>
        </div>
    </div>
</body>
</html>
