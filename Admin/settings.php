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

// Handle settings update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $siteTitle = $_POST['site_title'];
    $siteDescription = $_POST['site_description'];
    $stmt = $conn->prepare("UPDATE settings SET site_title = ?, site_description = ? WHERE id = 1");
    $stmt->bind_param("ss", $siteTitle, $siteDescription);
    $stmt->execute();
    $stmt->close();
}

// Fetch current settings
$result = $conn->query("SELECT * FROM settings WHERE id = 1");
if ($result && $result->num_rows > 0) {
    $settings = $result->fetch_assoc();
} else {
    // Handle case where no settings are found
    $settings = [
        'site_title' => '',
        'site_description' => ''
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Settings</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    /* Reset margins and paddings */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
}

.dashboard {
    display: flex;
    min-height: 100vh;
}

/* Sidebar styling */
aside {
    width: 250px;
    background-color: #333;
    color: white;
    padding: 20px;
    position: fixed;
    height: 100vh;
    animation: slideIn 1s ease;
}

aside h2 {
    text-align: center;
    color: #f39c12;
}

aside ul {
    list-style: none;
    margin-top: 20px;
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

/* Main content styling */
main {
    flex-grow: 1;
    margin-left: 250px;
    padding: 40px;
    background-color: #fff;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    animation: fadeIn 1s ease;
}

.settings-container {
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    max-width: 600px;
    margin: auto;
    animation: fadeInUp 1s ease;
}

.settings-container h2 {
    color: #333;
    margin-bottom: 20px;
    text-align: center;
}

.settings-container form {
    display: flex;
    flex-direction: column;
}

.settings-container form label {
    margin-bottom: 8px;
    font-weight: bold;
    color: #555;
}

.settings-container form input,
.settings-container form textarea {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    border-radius: 4px;
    transition: border-color 0.3s;
}

.settings-container form input:focus,
.settings-container form textarea:focus {
    border-color: #f39c12;
    outline: none;
}

.settings-container form button {
    background-color: #f39c12;
    color: white;
    border: none;
    padding: 12px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.3s;
}

.settings-container form button:hover {
    background-color: #e67e22;
    transform: scale(1.05);
}

/* Animations */
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes fadeInUp {
    from { transform: translateY(30px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

@keyframes slideIn {
    from { transform: translateX(-100%); }
    to { transform: translateX(0); }
}

</style>
<body>
    <div class="dashboard">
        <aside>
            <h2>Admin Panel</h2>
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
            <section class="settings-container">
                <h2>Site Settings</h2>
                <form method="post" action="">
                    <label for="site_title">Site Title:</label>
                    <input type="text" id="site_title" name="site_title" value="<?php echo htmlspecialchars($settings['site_title']); ?>" required>

                    <label for="site_description">Site Description:</label>
                    <textarea id="site_description" name="site_description" rows="4" required><?php echo htmlspecialchars($settings['site_description']); ?></textarea>

                    <button type="submit">Save Changes</button>
                </form>
            </section>
        </main>
    </div>
</body>
</html>
