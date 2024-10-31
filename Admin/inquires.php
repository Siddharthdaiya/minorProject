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

// Fetch inquiries
$sql = "SELECT * FROM inquiries";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquiries</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f69314;
            color: white;
        }
    </style>
</head>
<body>

<h1>Rental Property Inquiries</h1>

<table>
    <tr>
        <th>Property Name</th>
        <th>Price</th>
        <th>Address</th>
        <th>Mobile</th>
        <th>Email</th>
        <th>Inquiry Time</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['property_name']}</td>
                    <td>₹{$row['property_price']}/month</td>
                    <td>{$row['property_address']}</td>
                    <td>{$row['user_mobile']}</td>
                    <td>{$row['user_email']}</td>
                    <td>{$row['inquiry_time']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No inquiries found</td></tr>";
    }

    // Close the connection
    $conn->close();
    ?>
</table>

</body>
</html>
