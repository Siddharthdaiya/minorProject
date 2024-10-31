<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: login.php");
    exit();
}

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

// Fetch rental properties
$sql = "SELECT id, name, price, address, image, sqft, mobile, email FROM rentproperty";
$result = $conn->query($sql);

// Handle inquiries form submission
// Handle inquiries form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['inquiry'])) {
    $property_id = $_POST['property_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $message = $_POST['message'];

    // Insert inquiry into database
    $inquiry_sql = "INSERT INTO inquiries (property_id, name, email, mobile, message) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($inquiry_sql);
    $stmt->bind_param("issss", $property_id, $name, $email, $mobile, $message);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $_SESSION['inquiry_success'] = true; // Set success session variable
    } else {
        echo "<script>alert('Failed to submit inquiry');</script>";
    }

    $stmt->close();
    
    // Redirect to avoid resubmission
    header("Location: rentalpropt.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Properties Listing</title>
    <style>
        /* Styling for the page */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        header {
            background-color: #f69314;
            color: white;
            text-align: center;
            padding: 1rem 0;
        }

        h1 {
            margin: 0;
            font-size: 2rem;
        }

        .container {
            display: flex;
            align-items: center;
            padding: 0 20px;
        }

        .container .back {
            background: url("Images/back-button (2).png");
            height: 32px;
            width: 32px;
            margin-right:350px;
            display: block;
            transition: transform 0.2s ease-in-out;
        }

        .back:hover {
            transform: scale(1.3);
        }

        .filters {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }

        .filters input {
            padding: 10px;
            width: 300px;
            margin-right: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .filters button {
            padding: 10px 20px;
            background-color: #f69314;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .filters button:hover {
            background-color: #333;
        }

        .property-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .property-card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
        }

        .property-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }

        .property-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .property-card:hover img {
            transform: scale(1.1);
        }

        .property-details {
            padding: 15px;
            text-align: center;
        }

        .property-details h2 {
            margin: 0;
            font-size: 1.5rem;
            color: #333;
        }

        .property-details p {
            margin: 10px 0;
            color: #555;
        }

        .property-details .property-price {
            font-size: 1.3rem;
            color: #f69314;
            font-weight: bold;
        }

        .property-details .property-address {
            font-size: 1rem;
            color: #666;
        }

        .property-details .property-sqft {
            font-size: 0.9rem;
            color: #888;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
    background-color: #fff;
    margin: 10% auto;
    padding: 30px;
    border: 1px solid #888;
    width: 80%;
    max-width: 600px;
    border-radius: 10px;
    position: relative;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

.inquiry-form {
    margin-top: 20px;
    background-color: #f7f7f7; 
    padding: 20px;
    border-radius: 8px; 
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.inquiry-form input, .inquiry-form textarea {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px; 
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px; 
    transition: border-color 0.3s;
}

.inquiry-form input:focus, .inquiry-form textarea:focus {
    border-color: #f69314; 
    outline: none; 
}

.inquiry-form button {
    background-color: #f69314; 
    color: white;
    padding: 12px 25px; 
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px; 
    transition: background-color 0.3s, transform 0.2s; 
}

.inquiry-form button:hover {
    background-color: #e6820b; 
    transform: scale(1.05); 
}
.close {
    color: #aaa; 
    float: right; 
    font-size: 28px; 
    font-weight: bold; 
    position: absolute; 
    top: 20px; 
    right: 20px; 
    cursor: pointer;
    transition: color 0.3s;
}

.close:hover,
.close:focus {
    color: black; 
    text-decoration: none; 
}


    </style>
</head>
<body>
    <header>
        <div class="container">
            <a href="index.php" class="back"></a>
            <h1>Find Your Rental Property</h1>
        </div>
    </header>


    <section class="filters">
        <input type="text" id="search" placeholder="Search by location or type...">
        <button onclick="filterRentalProperties()">Search</button>
    </section>

    <section id="rental-property-list" class="property-list">
        <?php
        // Display rental properties
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='property-card' data-id='" . $row["id"] . "' data-name='" . $row["name"] . "' data-price='" . $row["price"] . "' data-address='" . $row["address"] . "' data-sqft='" . $row["sqft"] . "' data-image='" . $row["image"] . "' data-mobile='" . $row["mobile"] . "' data-email='" . $row["email"] . "'>";
                echo "<img src='Images/" . htmlspecialchars($row["image"]) . "' alt='Property Image' class='property-image'>";
                echo "<div class='property-details'>";
                echo "<h2 class='property-name'>" . $row["name"] . "</h2>";
                echo "<p class='property-price'>₹" . $row["price"] . "/month</p>";
                echo "<p class='property-address'>" . $row["address"] . "</p>";
                echo "<p class='property-sqft'>Square Footage: " . $row["sqft"] . "</p>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>No results found</p>";
        }

        // Close the connection
        $conn->close();
        ?>
    </section>

    <!-- Modal for property details -->
    <div id="property-modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div id="modal-details">
                <!-- Property details will be dynamically added here -->
            </div>
            <!-- Inquiry Form -->
            <form action="rentalpropt.php" method="POST" class="inquiry-form">
                <input type="hidden" id="property-id" name="property_id">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <input type="tel" name="mobile" placeholder="Your Mobile" required>
                <textarea name="message" placeholder="Your Message" required></textarea>
                <button type="submit" name="inquiry">Send Inquiry</button>
            </form>
        </div>
    </div>

    <script>
        // JavaScript for displaying modal with property details
        document.addEventListener('DOMContentLoaded', function () {
            const propertyCards = document.querySelectorAll('.property-card');

            propertyCards.forEach(card => {
                card.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    const name = this.getAttribute('data-name');
                    const price = this.getAttribute('data-price');
                    const address = this.getAttribute('data-address');
                    const sqft = this.getAttribute('data-sqft');
                    const mobile = this.getAttribute('data-mobile');
                    const email = this.getAttribute('data-email');

                    const modalDetails = `
                        <h2>${name}</h2>
                        <p>Price: ₹${price}/month</p>
                        <p>Address: ${address}</p>
                        <p>Square Footage: ${sqft}</p>
                        <p>Contact: ${mobile}</p>
                        <p>Email: ${email}</p>
                    `;
                    document.getElementById('modal-details').innerHTML = modalDetails;

                    // Fill property ID in the inquiry form
                    document.getElementById('property-id').value = id;

                    // Show modal
                    document.getElementById('property-modal').style.display = 'block';
                });
            });

            // Close modal function
            document.querySelector('.close').addEventListener('click', function () {
                document.getElementById('property-modal').style.display = 'none';
            });

            // Close the modal if user clicks outside of the modal-content area
            window.addEventListener('click', function (event) {
                const modal = document.getElementById('property-modal');
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            });
        });

        // Close modal function
        function closeModal() {
            document.getElementById('property-modal').style.display = 'none';
        }
        document.addEventListener('DOMContentLoaded', function () {
        <?php if (isset($_SESSION['inquiry_success'])): ?>
            alert("Inquiry submitted successfully!");
            <?php unset($_SESSION['inquiry_success']); // Unset session variable after displaying ?>
        <?php endif; ?>
    });
    </script>
</body>
</html>
