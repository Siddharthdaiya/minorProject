<?php
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

// Get the data from the AJAX request
$property_id = $_POST['property_id'];
$property_name = $_POST['property_name'];
$property_price = $_POST['property_price'];
$property_address = $_POST['property_address'];
$user_mobile = $_POST['user_mobile'];
$user_email = $_POST['user_email'];

// Insert inquiry into the inquiries table
$sql = "INSERT INTO inquiries (property_id, property_name, property_price, property_address, user_mobile, user_email)
        VALUES ('$property_id', '$property_name', '$property_price', '$property_address', '$user_mobile', '$user_email')";

if ($conn->query($sql) === TRUE) {
    echo "Inquiry submitted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>
