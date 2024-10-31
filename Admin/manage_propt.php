<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

include 'config.php';

// Fetch properties
$properties = $conn->query("SELECT * FROM property");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Properties</title>
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
    padding: 20px 0; 
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
}

header h1 {
    text-align: center;
    margin: 0 0 10px; 
    font-size: 24px; 
}

header .nav_bar {
    display: flex;
    justify-content: space-between;
    align-items: center; 
    padding: 0 40px;
}

header .nav_bar ul {
    display: flex;
    list-style: none; 
    margin: 0;
    padding: 0;
}


header .nav_bar ul li {
    margin-right: 20px; 
}
header .nav_bar ul li a {
    color: #f39c12; 
    text-decoration: none;
    font-size: 16px;
    padding: 10px 15px; 
    border-radius: 4px;
    transition: background-color 0.3s ease, color 0.3s ease;
}

header .nav_bar ul li a:hover {
    background-color: white; 
    color: #333; 
}
header .nav_bar a.logout {
    color: #f39c12; 
    text-decoration: none;
    padding: 10px 20px; 
    font-size: 16px;
    background-color: #444; 
    border-radius: 4px;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

header .nav_bar a.logout:hover {
    background-color: #f39c12; 
    color: white; 
    transform: scale(1.05); 
}

        /* Main content styling */
        .container {
            padding: 20px 20px 20px;
        }

        .container h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .table-container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f39c12;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
            transition: background-color 0.3s;
        }

        td img {
            max-width: 100px;
            height: auto;
        }

        .actions {
            text-align: center;
        }

        .actions a {
            display: inline-block;
            padding: 8px 8px;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin: 6px 15px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .actions a.edit {
            background-color: #3498db;
        }

        .actions a.delete {
            background-color: #e74c3c;
        }

        .actions a.edit:hover {
            background-color: #2980b9;
            transform: scale(1.05);
        }

        .actions a.delete:hover {
            background-color: #c0392b;
            transform: scale(1.05);
        }

        /* Keyframe animations */
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
    </style>
</head>
<body>
<header>
    <h1>Admin Side</h1>
    <nav class="nav_bar">
        <ul>
            <li><a href="dashboard.php">DashBoard</a></li>
            <li><a href="manage_user.php">Manage Users</a></li>
            <li><a href="manage_propt.php">Manage Properties</a></li>
            <li><a href="manage_rent.php">Manage Rental Property</a></li>
            <li><a href="rent_propt.php">Rent Property</a></li>
            <li><a href="reports.php">Reports</a></li>
            <li><a href="manage_admin.php">Manage Admins</a></li>
            <li><a href="settings.php">Settings</a></li>
        </ul>
        <a href="logout.php">Logout</a>
    </nav>
</header>


    <!-- Main content -->
    <div class="container">
        <h1>Manage Properties</h1>

        <!-- Display Properties -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Location</th>
                        <th>Price (₹)</th>
                        <th>Sq.ft</th>
                        <th>Mobile No</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $properties->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><img src="Images/<?php echo $row['image']; ?>" alt="Property Image"></td>
                            <td><?php echo htmlspecialchars($row['address']); ?></td>
                            <td><?php echo htmlspecialchars($row['price']); ?></td>
                            <td><?php echo htmlspecialchars($row['sqft']); ?></td>
                            <td><?php echo htmlspecialchars($row['mobile']); ?></td>
                            <td class="actions">
                                <a href="edit_property.php?id=<?php echo $row['id']; ?>" class="edit">Edit</a>
                                <a href="delete_property.php?id=<?php echo $row['id']; ?>" class="delete" onclick="return confirm('Are you sure you want to delete this property?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
