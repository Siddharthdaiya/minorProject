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

// Fetch data for the reports (sample queries)
$totalUsers = $conn->query("SELECT COUNT(*) AS count FROM users")->fetch_assoc()['count'];
$totalProperties = $conn->query("SELECT COUNT(*) AS count FROM property")->fetch_assoc()['count'];
$newInquiries = $conn->query("SELECT COUNT(*) AS count FROM inquiries WHERE DATE(created_at) = CURDATE()")->fetch_assoc()['count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to the CSS file -->
</head>
<style>
    /* General Styles for Body and Dashboard */
body {
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f2f5;
    color: #333;
}

.dashboard {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

header {
    background-color: #f39c12;
    color: white;
    padding: 20px;
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
    font-size: 28px;
    font-weight: 700;
}

nav a {
    color: #ffffff;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s;
}

nav a:hover {
    color: #e0e0e0;
}

/* Sidebar Styles */
aside {
    background-color: #2c3e50;
    color: white;
    width: 260px;
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
    color: #ecf0f1;
    text-decoration: none;
    font-size: 16px;
    display: block;
    padding: 12px;
    border-radius: 4px;
    transition: background-color 0.3s, color 0.3s;
}

aside ul li a:hover {
    background-color: #34495e;
    color: #f39c12;
}

/* Main Content Area */
main {
    margin-left: 260px; /* Sidebar width */
    padding: 20px;
    flex: 1;
}

/* General Styles for Reports */
.reports {
    background-color: #ffffff;
    padding: 100px;
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    animation: fadeIn 1s ease-out;
    margin: -20px 50px 50px 50px;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.reports h2 {
    margin-bottom: 30px;
    font-size: 32px;
    font-weight: 700;
    color: #004d99;
}

.reports .card {
    background-color: #007bff;
    color: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
}

.reports .card:hover {
    background-color: #f39c12;
    transform: scale(1.05);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.reports .card h3 {
    margin: 0;
    font-size: 22px;
    font-weight: 600;
}

.reports .card p {
    font-size: 36px;
    font-weight: 700;
    margin: 10px 0 0;
}

</style>
<body>
    <div class="dashboard">
        <header>
            <h1>Reports</h1>
            <nav>
                <a href="login.php">Logout</a>
            </nav>
        </header>
        <aside>
            <ul>
                <li><a href="dashboard.php">DashBoard</a></li>
                <li><a href="manage_user.php">Manage Users</a></li>
                <li><a href="manage_propt.php">Manage Properties</a></li>
                <li><a href="reports.php">Reports</a></li>
                <li><a href="manage_admin.php">Manage Admins</a></li>
                <li><a href="rent_propt.php">Rent property</a></li>
                <li><a href="manage_rent.php">Manage Rental Property</a></li>
                <li><a href="settings.php">Settings</a></li>
            </ul>
        </aside>
        <main>
            <section class="reports">
                <h2>Site Statistics</h2>
                <div class="card">
                    <h3>Total Users</h3>
                    <p><?php echo htmlspecialchars($totalUsers); ?></p>
                </div>
                <div class="card">
                    <h3>Total Properties</h3>
                    <p><?php echo htmlspecialchars($totalProperties); ?></p>
                </div>
                <div class="card">
                    <h3>New Inquiries Today</h3>
                    <p><?php echo htmlspecialchars($newInquiries); ?></p>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
