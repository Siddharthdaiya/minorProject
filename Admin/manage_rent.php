<?php 
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: login.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "realestate";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize error and message variables
$error = '';
$message = '';

// Fetch rental properties
$sql = "SELECT * FROM rentproperty";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Rental Properties</title>
    <style>
/* General reset for margin and padding */
body, h1, h2, p, ul, li, a {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* General styling for the body */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    color: #333;
}

/* Header styling */
header {
    background-color: #333;
    color: white;
    padding: 15px;
    text-align: center;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
header h1 {
    margin: 0;
    font-size: 24px;
}

header nav {
    margin-top: 10px;
}

header nav li a {
    color: #f39c12;
    text-decoration: none;
    font-size: 16px;
    margin: 0 10px;
    transition: color 0.3s ease;
}

header nav a:hover {
    color: #e67e22;
}
header .nav_bar{
    display:flex;
    text-decoration:none;
}
header .nav_bar a{
    text-decoration:none;  
}
header .nav_bar a.logout:hover {
    background-color: #f39c12; 
    color: white; 
    transform: scale(1.05); 
}


/* Main content styling */
main {
    padding: 20px;
    background: white;
    min-height: calc(100vh - 90px); /* Adjust based on header height */
}

/* Form container styling */
.form-container {
    max-width: 1200px;
    margin: 0 auto; /* Center the container horizontally */
    padding: 10px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    animation: fadeIn 1s ease-out;
}

.form-container h2 {
    margin-bottom: 20px;
    color: #333;
    font-size: 24px;
    text-align: center;
}

.form-container label {
    display: block;
    margin-bottom: 10px;
    color: #555;
    font-size: 14px;
}

.form-container input, .form-container textarea {
    width: calc(100% - 20px);
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

.form-container input:focus, .form-container textarea:focus {
    border-color: #f39c12;
    box-shadow: 0 0 5px rgba(243, 156, 18, 0.5);
    outline: none;
}

.form-container button {
    background-color: #f39c12;
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.form-container button:hover {
    background-color: #e67e22;
    transform: scale(1.05);
}

.message, .error {
    margin: 10px 0;
    padding: 15px;
    border-radius: 6px;
    font-size: 14px;
    text-align: center;
    animation: fadeIn 1s ease-out;
}

.message {
    background-color: #d4edda;
    color: #155724;
}

.error {
    background-color: #f8d7da;
    color: #721c24;
}

/* Table styling */
.table-container {
    max-width: 1200px;
    margin: 0 auto;
    background: white;
    border-radius: 8px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    overflow-x: auto;
}

.table-container table {
    width: 100%;
    border-collapse: collapse;
}

.table-container th, .table-container td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: left;
}

.table-container th {
    background-color: #f39c12;
    color: white;
}

.table-container td {
    background-color: #fff;
}

.table-container td img {
    max-width: 100px;
    height: auto;
}

.table-container .actions {
    text-align: center;
}

.table-container .actions a {
    display: inline-block;
    padding: 8px 8px;
    color: white;
    text-decoration: none;
    border-radius: 4px;
    margin: 6px 15px;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.table-container .actions a.edit {
    background-color: #3498db;
}

.table-container .actions a.delete {
    background-color: #e74c3c;
}

.table-container .actions a.edit:hover {
    background-color: #2980b9;
    transform: scale(1.05);
}

.table-container .actions a.delete:hover {
    background-color: #c0392b;
    transform: scale(1.05);
}

/* Keyframe animations */
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

    </style>
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <nav class="nav_bar">
                <li><a href="dashboard.php">DashBoard</a></li>
                <li><a href="manage_user.php">Manage Users</a></li>
                <li><a href="manage_propt.php">Manage Properties</a></li>
                <li><a href="reports.php">Reports</a></li>
                <li><a href="manage_admin.php">Manage Admins</a></li>
                <li><a href="rent_propt.php">Rent property</a></li>
                <li><a href="manage_rent.php">Manage Rental Property</a></li>
                <li><a href="settings.php">Settings</a></li>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <main>
        <div class="form-container">
            <h2>Manage Rental Properties</h2>
            <?php if (isset($message)): ?>
                <div class="message"><?php echo $message; ?></div>
            <?php endif; ?>
            <?php if (isset($error)): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Property Name</th>
                            <th>Price (₹)</th>
                            <th>Address</th>
                            <th>Image</th>
                            <th>Square Footage</th>
                            <th>Mobile Number</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo number_format($row['price']); ?></td>
                                    <td><?php echo $row['address']; ?></td>
                                    <td><img src="Images/<?php echo $row['image']; ?>" alt="Property Image"></td>
                                    <td><?php echo $row['sqft']; ?></td>
                                    <td><?php echo $row['mobile']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td class="actions">
                                        <a href="edit_rentpropt.php?id=<?php echo $row['id']; ?>" class="edit">Edit</a>
                                        <a href="delete_rentpropt.php?id=<?php echo $row['id']; ?>" class="delete" onclick="return confirm('Are you sure you want to delete this property?');">Delete</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9">No rental properties found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>
