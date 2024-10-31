<?php
include 'Admin/config.php'; // Your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $property_id = $_POST['property_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $message = $_POST['message'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO enquiries (property_id, name, email, mobile, message) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $property_id, $name, $email, $mobile, $message);

    if ($stmt->execute()) {
        echo "Enquiry submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
