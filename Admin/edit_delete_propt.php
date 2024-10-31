<?php
include 'config.php';

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM properties WHERE id = ?");
$stmt->bind_param("i", $id);
if ($stmt->execute()) {
    echo "Property deleted successfully!";
} else {
    echo "Error: " . $stmt->error;
}

header("Location: manage_properties.php");
?>
