<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: login.php");
    exit();
}

// Include database connection file
include 'config.php';

// Handle user deletion
if (isset($_GET['delete'])) {
    $userId = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->close();
}

// Handle user addition
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_user'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->close();
}

// Fetch users from the database
$result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to the CSS file -->
</head>
<style>
    /* General Body and Dashboard Styles */
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.dashboard {
    display: flex;
    min-height: 100vh;
    flex-direction: column;
}
a {
    color:red;
    text-decoration:none;
}
header {
    background-color: #f39c12;
    color: white;
    padding: 15px 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: sticky;
    top: 0;
    z-index: 1000;
}

header h1 {
    margin: 0;
    font-size: 24px;
    font-weight: 600;
}

nav a {
    color: white;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s;
}

nav a:hover {
    color: #f39c12;
}

/* Sidebar Styles */
aside {
    background-color: #343a40;
    color: white;
    width: 250px;
    padding: 20px;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    position: fixed;
    top: 0;
    bottom: 0;
    overflow-y: auto;
}

aside ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

aside ul li {
    margin-bottom: 15px;
}

aside ul li a {
    color: #cfd8dc;
    text-decoration: none;
    font-size: 16px;
    display: block;
    padding: 10px;
    border-radius: 4px;
    transition: background-color 0.3s, color 0.3s;
}

aside ul li a:hover {
    background-color: #495057;
    color: #f39c12;
}

/* Main Content Area */
main {
    margin-left: 250px; /* Sidebar width */
    padding: 20px;
    flex: 1;
}

    /* General Styles for User Management */
.user-management {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    animation: fadeIn 0.8s ease-out;
    max-width: 1200px;
    margin: 0px 50px 50px 50px;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.user-management table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.user-management table th,
.user-management table td {
    padding: 12px;
    border-bottom: 1px solid #e0e0e0;
    text-align: left;
    transition: background-color 0.3s, color 0.3s;
}

.user-management table th {
    background-color: ##f39c12;
    font-weight: 600;
}

.user-management table tr:hover {
    background-color: #f0f0f0;
}

.user-management form {
    margin-top: 20px;
}

.user-management form label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
}

.user-management form input,
.user-management form textarea {
    width: 100%;
    padding: 12px;
    margin-bottom: 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
    transition: border-color 0.3s, box-shadow 0.3s;
}

.user-management form input:focus,
.user-management form textarea:focus {
    border-color: #f39c12;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
    outline: none;
}

.user-management form button {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
    font-size: 16px;
}

.user-management form button:hover {
    background-color: #f39c12;
    transform: scale(1.05);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
}

</style>
<body>
    <div class="dashboard">
        <header>
            <h1>Manage Users</h1>
            <nav>
                <a href="login.php">Logout</a>
            </nav>
        </header>
        <aside>
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
        <main>
            <section class="user-management">
                <h2>User List</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['id']); ?></td>
                                <td><?php echo htmlspecialchars($row['username']); ?></td>
                                <td>
                                    <a href="?delete=<?php echo htmlspecialchars($row['id']); ?>" onclick="return confirm('Are you sure?');">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <h2>Add New User</h2>
                <form method="post" action="">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                    <button type="submit" name="add_user">Add User</button>
                </form>
            </section>
        </main>
    </div>
</body>
</html>
