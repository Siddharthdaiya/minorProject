<?php
include 'config.php';
    
    session_start();

    if(!isset($_SESSION['admin_logged_in'])){
        header("Location: login.php");
        exit;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="dash.css"> <!-- Link to the CSS file -->
    <style>
        /* General Styling for the Dashboard */
body {
    font-family: 'Poppins', sans-serif;
    background-color: #f4f4f9;
    margin: 0;
    padding: 0;
    overflow-x: hidden;
    transition: background-color 0.3s ease;
}

/* Header Styling */
header {
    background-color: #333;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 50px;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1000;
    height: 60px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    animation: fadeIn 0.5s ease-in-out;
}

header h1 {
    margin: 0;
    font-size: 24px;
    font-weight: bold;
}

nav a {
    color: white;
    text-decoration: none;
    padding: 10px 20px;
    margin:100px;
    background-color: #f39c12;
    border-radius: 5px;
    transition: background-color 0.3s, transform 0.3s;
}

nav a:hover {
    background-color: #e67e22;
    transform: translateY(-3px);
}

/* Sidebar and Main Layout */
.dashboard {
    display: flex;
    margin-top: 60px; /* To account for fixed header */
    height: calc(100vh - 60px); /* Subtract header height from full view height */
}

aside {
    background-color: #444;
    width: 200px;
    padding: 20px;
    height: 100vh;
    position: fixed;
    top: 60px;
    left: 0;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    transition: width 0.3s ease;
}

aside:hover {
    width: 220px;
}

/* Sidebar Links */
aside ul {
    list-style: none;
    padding: 0;
}

aside ul li {
    margin-bottom: 20px;
}

aside ul li a {
    color: white;
    text-decoration: none;
    font-size: 18px;
    display: block;
    padding: 10px;
    background-color: #555;
    border-radius: 5px;
    transition: background-color 0.3s, transform 0.3s;
}

aside ul li a:hover {
    background-color: #f39c12;
    transform: translateX(10px);
}

/* Main Content */
main {
    margin-left: 220px; /* Adjust for the sidebar width */
    padding: 20px;
    overflow-y: auto;
    width: calc(100% - 220px);
    box-sizing: border-box;
    animation: fadeIn 0.5s ease-in-out;
}

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

/* Card Layout for Manage Properties Section */
.manage-properties {
    display: flex;
    gap: 20px;
    justify-content: space-between;
    flex-wrap: wrap; /* Cards will wrap on smaller screens */
}

.card {
    background-color: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    padding: 25px;
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    flex: 1;
    max-width: 300px; /* Cards won't get too large */
    margin-bottom: 20px;
    box-sizing: border-box;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.card h3 {
    margin-bottom: 10px;
    font-size: 20px;
    color: #333;
    animation: slideIn 0.5s ease;
}

.card a {
    text-decoration: none;
    color: white;
    background-color: #f39c12;
    padding: 10px 20px;
    border-radius: 5px;
    transition: background-color 0.3s, transform 0.3s;
}

.card a:hover {
    background-color: #e67e22;
    transform: translateY(-3px);
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    aside {
        width: 180px;
    }

    aside:hover {
        width: 200px;
    }

    main {
        margin-left: 200px;
        width: calc(100% - 200px);
    }

    .card {
        max-width: 100%;
    }
}

    </style>
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <nav>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <div class="dashboard">
        <aside>
            <ul>
                <li><a href="manage_user.php">Manage Users</a></li>
                <li><a href="manage_propt.php">Manage Properties</a></li>
                <li><a href="reports.php">Reports</a></li>
                <li><a href="manage_admin.php">Manage Admins</a></li>
                <li><a href="rent_propt.php">Rent property</a></li>
                <li><a href="manage_rent.php">Manage Rental Property</a></li>
                <li><a href="settings.php">Settings</a></li>
            </ul>
        </aside>

        <main>
            <section class="welcome">
                <h2>Welcome, <?php echo $_SESSION['admin_logged_in']; ?></h2>
                <p>Here you can manage the real estate website, view reports, and configure settings.</p>
            </section>

            <!-- Property Management Section -->
            <section class="manage-properties">
                <div class="card">
                    <h3>Insert Property</h3>
                    <a href="insert_property.php">Insert</a>
                </div>
                <div class="card">
                    <h3>Update Property</h3>
                    <a href="edit_property.php">Update</a>
                </div>
                <div class="card">
                    <h3>View users</h3>
                    <a href="manage_user.php">Users</a>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
