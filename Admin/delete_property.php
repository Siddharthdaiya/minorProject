<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

include 'config.php';

// Delete property
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // First, delete any related enquiries
    $deleteEnquiries = $conn->prepare("DELETE FROM enquiries WHERE property_id = ?");
    $deleteEnquiries->bind_param("i", $id);
    $deleteEnquiries->execute();
    
    // Then, delete the property
    $stmt = $conn->prepare("DELETE FROM property WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: manage_propt.php");
        exit();
    } else {
        $error = "Error: " . $stmt->error;
    }
}
?>
