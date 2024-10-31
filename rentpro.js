// Function to open the modal
function openModal(propertyId) {
    const modal = document.getElementById('property-modal');
    const modalDetails = document.getElementById('modal-details');

    // Fetch property details from the server
    fetch(`getPropertyDetails.php?id=${propertyId}`)
        .then(response => response.json())
        .then(data => {
            modalDetails.innerHTML = `
                <h2>${data.name}</h2>
                <p>Price: ₹${data.price}/month</p>
                <p>Address: ${data.address}</p>
                <p>Square Footage: ${data.sqft}</p>
                <p>Contact: ${data.mobile}</p>
                <p>Email: ${data.email}</p>
            `;
            modal.style.display = 'block';
        });
}

// Function to close the modal
function closeModal() {
    const modal = document.getElementById('property-modal');
    modal.style.display = 'none';
}

// Function to filter rental properties (if you have filtering logic)
function filterRentalProperties() {
    const searchQuery = document.getElementById('search').value;
    // Implement search/filter logic here
}
