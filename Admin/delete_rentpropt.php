<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

include 'config.php';

// Delete rental property
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the SQL statement to delete the rental property
    $stmt = $conn->prepare("DELETE FROM rentproperty WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        // Redirect to manage rental properties page after successful deletion
        header("Location: manage_rentp.php");
        exit();
    } else {
        $error = "Error: " . $stmt->error;
        echo $error; // Display error if deletion fails
    }
} else {
    echo "No ID provided."; // Handle case when no ID is specified
}
?>
