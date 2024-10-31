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

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form inputs
    $property_name = $conn->real_escape_string($_POST['property_name']);
    $property_price = $conn->real_escape_string($_POST['property_price']);
    $property_address = $conn->real_escape_string($_POST['property_address']);
    $property_sqft = $conn->real_escape_string($_POST['property_sqft']);
    $property_mobile = $conn->real_escape_string($_POST['property_mobile']);
    $property_email = $conn->real_escape_string($_POST['property_email']);

    $file = '';

    // Check if a file was uploaded
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        // Define the allowed file types
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        
        // Get the file information
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileSize = $_FILES['file']['size'];
        $fileType = $_FILES['file']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        
        // Define allowed extensions
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        
        // Check if the file type is allowed
        if (in_array($fileType, $allowedTypes) && in_array($fileExtension, $allowedExtensions)) {
            // Set the upload directory
            $uploadDir = 'Images/';
            
            // Create the uploads directory if it doesn't exist
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            // Define the upload path
            $uploadFile = $uploadDir . basename($fileName);
            
            // Move the file to the upload directory
            if (move_uploaded_file($fileTmpPath, $uploadFile)) {
                $file = $fileName; // Store the filename for database insertion
            } else {
                $error = 'There was an error uploading the file, please try again.';
            }
        } else {
            $error = 'Unsupported file type or file extension.';
        }
    } else {
        $error = 'No file was uploaded or there was an upload error: ' . $_FILES['file']['error'];
    }

    // Check if the property already exists
    if (empty($error)) {
        $checkSql = "SELECT * FROM rentproperty WHERE name = '$property_name' AND address = '$property_address'";
        $checkResult = $conn->query($checkSql);

        if ($checkResult->num_rows > 0) {
            $error = 'A property with this name and address already exists.';
        } else {
            // Insert into database if no error
            if (empty($error)) {
                $sql = "INSERT INTO rentproperty (name, price, address, image, sqft, mobile, email) VALUES ('$property_name', '$property_price', '$property_address', '$file', '$property_sqft', '$property_mobile', '$property_email')";
                
                if ($conn->query($sql) === TRUE) {
                    $message = "New rental property inserted successfully";
                } else {
                    $error = "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Rental Property</title>
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

header nav a {
    color: #f39c12;
    text-decoration: none;
    font-size: 16px;
    margin-left: 20px;
    transition: color 0.3s ease;
}

header nav a:hover {
    color: #e67e22;
}

/* Dashboard layout styling */
.dashboard {
    display: flex;
    min-height: calc(100vh - px); /* Adjust based on header height */
    background-color: #f4f4f4;
    animation: fadeIn 1s ease-out;
}

aside {
    width: 250px;
    background-color: #333;
    color: #fff;
    padding: 20px;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    height: 100%;
    animation: slideIn 0.5s ease-out;
}

aside h2 {
    color: #f39c12;
    margin-top: 0;
}

aside ul {
    list-style: none;
    padding: 0;
}

aside ul li {
    margin-bottom: 10px;
}

aside ul li a {
    color: #fff;
    text-decoration: none;
    font-size: 16px;
    display: block;
    padding: 10px;
    border-radius: 4px;
    transition: background-color 0.3s ease, color 0.3s ease;
}

aside ul li a:hover {
    background-color: #f39c12;
    color: #333;
}

/* Main content styling */
main {
    flex: 1;
    padding: 10px;
    background:white;
    /* margin-left: 50px; Space for the sidebar */
}

/* Form container styling */
.form-container {
    max-width: 600px;
    margin: 0px 20px; /* Center the container horizontally */
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

/* Keyframe animations */
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes slideIn {
    from {
        transform: translateX(-20px);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}



    </style>
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <nav>
            <a href="login.php">Logout</a>
        </nav>
    </header>

    <div class="dashboard">
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
            <div class="form-container">
                <h2>Insert Rental Property</h2>
                <?php if (isset($message)): ?>
                    <div class="message"><?php echo $message; ?></div>
                <?php endif; ?>
                <?php if (isset($error)): ?>
                    <div class="error"><?php echo $error; ?></div>
                <?php endif; ?>
                <form action="rent_propt.php" method="post" enctype="multipart/form-data">
                    <label for="property_name">Property Name:</label>
                    <input type="text" id="property_name" name="property_name" required>
                    
                    <label for="property_price">Price (₹):</label>
                    <input type="number" id="property_price" name="property_price" required>
                    
                    <label for="property_address">Address:</label>
                    <input type="text" id="property_address" name="property_address" required>
                    
                    <label for="file">Image:</label>
                    <input type="file" id="file" name="file" required>
                    
                    <label for="property_sqft">Square Footage:</label>
                    <input type="number" id="property_sqft" name="property_sqft" required>
                    
                    <label for="property_mobile">Mobile Number:</label>
                    <input type="text" id="property_mobile" name="property_mobile" required>
                    
                    <label for="property_email">Email:</label>
                    <input type="email" id="property_email" name="property_email" required>
                    
                    <button type="submit">Insert Property</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
