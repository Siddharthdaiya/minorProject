<?php
// Start the session
session_start();


include "admin/config.php";

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

    // Check if a file was uploaded
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        // Define the allowed file types
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        
        // Get the file information
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
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

    // Insert into database if no error
    if (empty($error)) {
        $sql = "INSERT INTO property (name, price, address, image, sqft, mobile, email) VALUES ('$property_name', '$property_price', '$property_address', '$file', '$property_sqft', '$property_mobile', '$property_email')";
        
        if ($conn->query($sql) === TRUE) {
            $message = "New property inserted successfully";
        } else {
            $error = "Error: " . $sql . "<br>" . $conn->error;
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
    <title>Insert Property</title>
    <!-- <link rel="stylesheet" href="dash.css"> Link to the CSS file -->
</head>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    color: #333;
    margin: 0;
    padding: 0;
}

header {
            background-color: #f69314;
            color: white;
            text-align: center;
            padding: 1rem 0;
        }
        .container {
            display: flex;
            /* justify-content: space-between; */
            align-items: center;
            padding: 0 20px;
        }
        h1 {
            margin: 0px 350px;
            font-size: 2rem;
        }
        .back {
            background: url("Images/back-button (2).png");
            height: 32px;
            width: 32px;
            display: block;
            transition: transform 0.2s ease-in-out;
        }

        .back:hover {
            transform: scale(1.3);
        }
.form-container {
    max-width: 600px;
    margin:50px auto;
    padding: 30px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    animation: fadeIn 1s ease-in-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
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
    transition: color 0.3s ease;
}

.form-container input {
    width: calc(100% - 20px);
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

.form-container input:focus {
    border-color: #f39c12;
    box-shadow: 0 0 5px rgba(243, 156, 18, 0.5);
    outline: none;
}

.form-container input[type="file"] {
    padding: 5px;
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
    animation: popIn 0.5s ease;
}

@keyframes popIn {
    0% {
        transform: scale(0.95);
    }
    100% {
        transform: scale(1);
    }
}

.form-container button:hover {
    background-color: #e67e22;
    transform: scale(1.05);
}

.form-container button:focus {
    outline: none;
}

.form-container button:active {
    transform: scale(0.95);
}

.message, .error {
    margin: 10px 0;
    padding: 15px;
    border-radius: 6px;
    font-size: 14px;
    text-align: center;
    animation: slideIn 0.5s ease;
}

@keyframes slideIn {
    from {
        transform: translateY(-20px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.message {
    background-color: #d4edda;
    color: #155724;
}

.error {
    background-color: #f8d7da;
    color: #721c24;
}
</style>
<body>
<header>
        <div class="container">
            <a href="index.php" class="back"></a>
            <h1>Sell Your Property</h1>
        </div>
    </header>
    <div class="form-container">
        <h2>Add Property Details</h2>
        <?php if (!empty($message)): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        <?php if (!empty($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="sellpro.php" method="post" enctype="multipart/form-data">
            <label for="property_name">Property Name:</label>
            <input type="text" id="property_name" name="property_name" required>
            
            <label for="property_price">Price (₹):</label>
            <input type="number" id="property_price" name="property_price" required>
            
            <label for="property_address">Address:</label>
            <input type="text" id="property_address" name="property_address" required>
            
            <label for="property_image">Image:</label>
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
</body>
</html>
