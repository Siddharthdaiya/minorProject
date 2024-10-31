<?php
include 'Admin/config.php'; // Include your database connection file


$propertyId = $_GET['id'];


$sql = "SELECT id, name, price, address, image, sqft, description FROM property WHERE id = ?";


$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $propertyId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $property = $result->fetch_assoc();
    echo json_encode($property);
} else {
    echo json_encode(array("error" => "Property not found"));
}


$stmt->close();
$conn->close();
?>
