<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Properties Listing</title>
        <!-- Bootstrap CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* General Body and Header Styles */
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
            margin: 0px 340px;
            font-size: 2rem;
        }

        /* Container for the Header */
        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .back {
            background: url("Images/back-button (2).png");
            height: 32px;
            width: 32px;
            display: block;
            transition: transform 0.2s ease-in-out;
        }

        .back:hover {
            transform: scale(1.3);
        }

        /* Filters Section */
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
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .filters button:hover {
            background-color: #e67e22;
            transform: scale(1.05);
        }

        /* Property List and Card Styling */
        .property-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        /* Enhanced Property Card Styling */
        .property-card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            padding: 0;
            margin-bottom: 20px;
            cursor: pointer;
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
            color: #f69314;
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

        /* Modal Styles */
    /* Enhanced Modal Styles */
.modal-content {
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease, opacity 0.3s ease;
    transform: scale(0.9);
    opacity: 0;
}

.modal.fade .modal-content {
    transform: scale(1);
    opacity: 1;
}

.modal-header {
    background-color: #f69314;
    color: white;
    border-bottom: 1px solid #ddd;
    padding: 1rem;
}

.modal-footer {
    border-top: 1px solid #ddd;
    padding: 1rem;
}

.modal-body {
    padding: 2rem;
    background-color: #fafafa;
    color: #333;
}

/* Enquiry Form Styling */
#enquiry-form input, 
#enquiry-form textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    transition: border 0.3s ease, box-shadow 0.3s ease;
}

#enquiry-form input:focus, 
#enquiry-form textarea:focus {
    border: 1px solid #f69314;
    box-shadow: 0 4px 10px rgba(246, 147, 20, 0.2);
}

#enquiry-form button {
    width: 100%;
    padding: 10px;
    background-color: #f69314;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

#enquiry-form button:hover {
    background-color: #e67e22;
    transform: scale(1.05);
}

/* Smooth Fade-in Animation for Modal */
.modal.fade .modal-content {
    animation: fadeIn 0.5s ease-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: scale(0.95);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

/* Button Hover Effects */
.btn-primary, .btn-secondary {
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.btn-primary:hover {
    background-color: #e67e22;
    transform: scale(1.05);
}

.btn-secondary:hover {
    background-color: #bbb;
    transform: scale(1.05);
}


        .btn-secondary {
            background-color: #ccc;
            border-color: #bbb;
        }

        .btn-secondary:hover {
            background-color: #bbb;
            border-color: #aaa;
        }

        .btn-primary {
            background-color: #f69314;
            border-color: #e67e22;
        }

        .btn-primary:hover {
            background-color: #e67e22;
            border-color: #d35400;
        }

        /* Media Queries */
        @media (max-width: 768px) {
            .filters {
                flex-direction: column;
                align-items: center;
            }

            .filters input {
                margin-bottom: 10px;
                margin-right: 0;
            }

            .filters button {
                width: 100%;
                max-width: 300px;
            }

            .property-list {
                grid-template-columns: 1fr;
            }

            .container {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <a href="index.php" class="back"></a>
            <h1>Find Your Dream Property</h1>
        </div>
    </header>
    <section class="filters">
        <input type="text" id="search" placeholder="Search by location or type...">
        <button onclick="filterProperties()">Search</button>
    </section>

    <section id="property-list" class="property-list">
        <!-- Properties will be dynamically added here -->
        <?php
        include 'Admin/config.php'; // Include your database connection file

        // Define the SQL query
        $sql = "SELECT id, name, price, address, image, sqft FROM property"; // Adjust according to your schema
        $result = $conn->query($sql);

        // Check if there are results
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<div class='property-card' onclick='openModal(" . $row["id"] . ")'>";
                echo "<img src='Images/" . htmlspecialchars($row["image"]) . "' alt='Property Image' class='property-image'>";
                echo "<div class='property-details'>";
                echo "<h3 class='property-name'>" . $row["name"] . "</h3>";
                echo "<p class='property-address'>" . $row["address"] . "</p>";
                echo "<span class='property-price'>₹" . $row["price"] . "</span>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>No properties found</p>";
        }

        // Close the connection
        $conn->close();
        ?>
    </section>

    <div id="property-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Property Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-details">
                <!-- Property details will be dynamically added here -->
            </div>
            <div class="modal-body">
                <h5>Make an Enquiry</h5>
                <form id="enquiry-form">
                    <input type="hidden" id="property-id" name="property_id">
                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile Number</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="submitEnquiry()">Submit Enquiry</button>
                </form>
            </div>
        </div>
    </div>
</div>


    <!-- Bootstrap Modal -->
    <div id="property-modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Property Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-details">
                    <!-- Property details will be dynamically added here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="contactAgent()">Make An Enquiry</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
       function openModal(propertyId) {
    fetch(`get_property_details.php?id=${propertyId}`)
        .then(response => response.json())
        .then(data => {
            const modalDetails = document.getElementById('modal-details');
            modalDetails.innerHTML = `
                <h2>${data.name}</h2>
                <p><strong>Price:</strong> ₹${data.price}</p>
                <p><strong>Type:</strong> ${data.type}</p>
                <p><strong>Address:</strong>${data.address}</p>
                <p><strong>Sqft:</strong>${data.sqft}</p>
                <p><strong>Description:</strong>${data.description}</p>
            `;

            document.getElementById('property-id').value = propertyId; // Set property ID for enquiry
            $('#property-modal').modal('show'); // Show the modal using Bootstrap
        })
        .catch(error => console.error('Error:', error));
}







        // Function to handle contact agent button click
        function contactAgent() {
            // Simulate sending an email
            setTimeout(() => {
                const modalDetails = document.getElementById('modal-details');
                modalDetails.innerHTML = `
                    <h2>Enquiry Sent Successfully</h2>
                    <p>Thank you for your interest. The agent will contact you shortly.</p>
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                `;
            }, 500); // Simulate a delayz
        }

        // Function to filter properties based on search input
        function filterProperties() {
            let input = document.getElementById('search').value.toLowerCase();
            let propertyCards = document.getElementsByClassName('property-card');

            // Loop through all property cards and hide those that don't match the search query
            for (let i = 0; i < propertyCards.length; i++) {
                let propertyName = propertyCards[i].querySelector('.property-name').innerText.toLowerCase();
                let propertyAddress = propertyCards[i].querySelector('.property-address').innerText.toLowerCase();
                
                // If the search query matches either the name or address of the property, display it
                if (propertyName.includes(input) || propertyAddress.includes(input)) {
                    propertyCards[i].style.display = "";
                } else {
                    propertyCards[i].style.display = "none";
                }
            }
        }

        function submitEnquiry() {
    const formData = new FormData(document.getElementById('enquiry-form'));

    fetch('submit_enquiry.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        // Show a success message or handle error
        const modalDetails = document.getElementById('modal-details');
        modalDetails.innerHTML = `<h2>Enquiry Sent Successfully</h2><p>Thank you for your interest. The agent will contact you shortly.</p>`;
        setTimeout(() => {
            $('#property-modal').modal('hide');
        }, 2000);
    })
    .catch(error => console.error('Error:', error));
}


    </script>
</body>
</html>
