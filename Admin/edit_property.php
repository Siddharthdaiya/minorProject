<?php
session_start();
include 'config.php';

// Check if the user is logged in as admin
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: login.php");
    exit();
}

// Fetch property ID from URL
if (isset($_GET['id'])) {
    $property_id = intval($_GET['id']);

    // Fetch property details
    $stmt = $conn->prepare("SELECT * FROM property WHERE id = ?");
    $stmt->bind_param("i", $property_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $property = $result->fetch_assoc();

    if (!$property) {
        header("Location: manage_propt.php");
        exit();
    }
} else {
    header("Location: manage_propt.php");
    exit();
}

// Handle Update Property
if (isset($_POST['update_property'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $address = $_POST['address'];
    $sqft = $_POST['sqft'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $description = $_POST['description'];

    // Handle image file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "Images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is an actual image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image = $target_file; // Set the file path to save in the database
            } else {
                $error = "Sorry, there was an error uploading your file.";
            }
        } else {
            $error = "File is not an image.";
        }
    } else {
        // Use the existing image if no new file is uploaded
        $image = $property['image'];
    }

    // Update query with new fields for mobile, email, and description
    $stmt = $conn->prepare("UPDATE property SET name = ?, price = ?, address = ?, sqft = ?, mobile = ?, email = ?, description = ?, image = ? WHERE id = ?");
    $stmt->bind_param("ssssssssi", $name, $price, $address, $sqft, $mobile, $email, $description, $image, $property_id);

    if ($stmt->execute()) {
        $message = "Property updated successfully!";
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
    <title>Edit Property</title>
   
</head>
<style>
    /* General Styles */
body {
    font-family: 'Poppins', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    overflow-x: hidden;
    transition: background-color 0.3s ease;
}

/* Dashboard Container */
.dashboard {
    display: flex;
}

/* Sidebar */
aside {
    width: 250px;
    height: 100vh;
    background-color: #2c3e50;
    padding: 20px;
    position: fixed;
    top: 0;
    left: 0;
    overflow-y: auto;
    transition: width 0.3s ease;
}

aside:hover {
    width: 260px;
}

/* Sidebar Links */
aside h2 {
    color: #ecf0f1;
    font-size: 24px;
    text-align: center;
    margin-bottom: 20px;
}

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
    background-color: #34495e;
    border-radius: 4px;
    transition: background-color 0.3s, transform 0.3s;
}

aside ul li a:hover {
    background-color: #f39c12;
    transform: translateX(10px);
}

/* Main Content Area */
.container {
    margin-left: 300px;
    padding: 40px;
    flex: 1;
    background-color: #fff;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    animation: fadeIn 0.5s ease;
}

/* Fade in animation */
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

/* Headings */
h1 {
    color: #333;
    font-size: 32px;
    margin-bottom: 20px;
    text-align: center;
    animation: slideIn 0.6s ease;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Alerts */
.message, .error {
    padding: 15px;
    border-radius: 5px;
    margin-bottom: 20px;
    font-size: 16px;
    text-align: center;
    animation: pulse 0.8s ease infinite;
}

@keyframes pulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
    100% {
        transform: scale(1);
    }
}

.message {
    background-color: #d4edda;
    color: #155724;
    box-shadow: 0 0 10px rgba(0, 255, 0, 0.3);
}

.error {
    background-color: #f8d7da;
    color: #721c24;
    box-shadow: 0 0 10px rgba(255, 0, 0, 0.3);
}

/* Form Elements */
form input, form textarea, form button {
    margin-bottom: 20px;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 8px;
    width: 100%;
    box-sizing: border-box;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

form input:focus, form textarea:focus {
    border-color: #f39c12;
    box-shadow: 0 0 10px rgba(243, 156, 18, 0.3);
    outline: none;
}

/* Button Styling */
form button {
    background-color: #f39c12;
    color: white;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.3s;
    font-size: 18px;
}

form button:hover {
    background-color: #e67e22;
    transform: scale(1.05);
}

/* File Input */
input[type="file"] {
    border: 1px solid #ddd;
    background-color: #fff;
    padding: 10px;
    width: 100%;
    cursor: pointer;
}

input[type="file"]::file-selector-button {
    padding: 10px;
    background-color: #f39c12;
    color: white;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.3s;
}

input[type="file"]::file-selector-button:hover {
    background-color: #e67e22;
    transform: scale(1.05);
}

/* Form Label Styling */
form label {
    font-size: 16px;
    color: #333;
    margin-bottom: 8px;
    display: block;
    font-weight: bold;
    transition: color 0.3s ease;
}

form label:hover {
    color: #f39c12;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .container {
        margin-left: 0;
        padding: 20px;
    }

    aside {
        width: 100px;
    }

    aside ul li a {
        font-size: 16px;
        text-align: center;
    }

    aside ul li a:hover {
        transform: translateX(0);
    }

    form button {
        font-size: 16px;
    }

    form input, form textarea {
        font-size: 14px;
    }
}

</style>
<body>
    <div class="dashboard">
        <aside>
            <h2>Admin Panel</h2>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="manage_user.php">Manage Users</a></li>
                <li><a href="manage_propt.php">Manage Properties</a></li>
                <li><a href="reports.php">Reports</a></li>
                <li><a href="settings.php">Settings</a></li>
                <li><a href="manage_admin.php">Manage Admins</a></li>
            </ul>
        </aside>
        <div class="container">
            <h1>Edit Property</h1>

            <?php if (isset($message)): ?>
                <div class="message"><?php echo $message; ?></div>
            <?php endif; ?>
            <?php if (isset($error)): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="post" enctype="multipart/form-data" action="edit_property.php?id=<?php echo $property_id; ?>">
                <label for="name">Property Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($property['name'] ?? ''); ?>" required>

                <label for="price">Price:</label>
                <input type="text" id="price" name="price" value="<?php echo htmlspecialchars($property['price'] ?? ''); ?>" required>

                <label for="address">Address:</label>
                <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($property['address'] ?? ''); ?>" required>

                <label for="sqft">Square Footage:</label>
                <input type="text" id="sqft" name="sqft" value="<?php echo htmlspecialchars($property['sqft'] ?? ''); ?>" required>

                <label for="mobile">Mobile Number:</label>
                <input type="text" id="mobile" name="mobile" value="<?php echo htmlspecialchars($property['mobile'] ?? ''); ?>" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($property['email'] ?? ''); ?>" required>

                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4" required><?php echo htmlspecialchars($property['description'] ?? ''); ?></textarea>

                <label for="image">Select Image:</label>
                <input type="file" id="image" name="image">

                <button type="submit" name="update_property">Update Property</button>
            </form>
        </div>
    </div>
</body>
</html>
