// // Sample property data
// const properties = [
//     {
//         image: 'https://images.pexels.com/photos/280222/pexels-photo-280222.jpeg?auto=compress&cs=tinysrgb&w=600',
//         title: 'Modern Apartment',
//         location: 'New York, NY',
//         price: '$850,000',
//         type: 'Apartment',
//         description: 'This modern apartment is located in the heart of New York City with easy access to amenities. It features 2 bedrooms, 2 bathrooms, and a stunning view of the city skyline.'
//     },
//     {
//         image: 'https://images.pexels.com/photos/3935333/pexels-photo-3935333.jpeg?auto=compress&cs=tinysrgb&w=600',
//         title: 'Beach House',
//         location: 'Miami, FL',
//         price: '$950,000',
//         type: 'House',
//         description: 'Enjoy the ocean breeze from this beautiful beach house in Miami. The house includes 3 bedrooms, 2 bathrooms, and a private pool.'
//     },
//     {
//         image: 'https://images.pexels.com/photos/277667/pexels-photo-277667.jpeg?auto=compress&cs=tinysrgb&w=600',
//         title: 'Luxury Villa',
//         location: 'Los Angeles, CA',
//         price: '$1,200,000',
//         type: 'Villa',
//         description: 'This luxury villa in Los Angeles offers the ultimate in comfort and privacy. It has 5 bedrooms, 4 bathrooms, a large garden, and a swimming pool.'
//     }
//     ,
//     {
//         image: 'https://images.pexels.com/photos/3935333/pexels-photo-3935333.jpeg?auto=compress&cs=tinysrgb&w=600',
//         title: 'Beach House',
//         location: 'Miami, FL',
//         price: '$950,000',
//         type: 'House',
//         description: 'Enjoy the ocean breeze from this beautiful beach house in Miami. The house includes 3 bedrooms, 2 bathrooms, and a private pool.'
//     },
//     {
//         image: 'https://images.pexels.com/photos/280222/pexels-photo-280222.jpeg?auto=compress&cs=tinysrgb&w=600',
//         title: 'Modern Apartment',
//         location: 'New York, NY',
//         price: '$850,000',
//         type: 'Apartment',
//         description: 'This modern apartment is located in the heart of New York City with easy access to amenities. It features 2 bedrooms, 2 bathrooms, and a stunning view of the city skyline.'
//     },
//     {
//         image: 'https://images.pexels.com/photos/3935333/pexels-photo-3935333.jpeg?auto=compress&cs=tinysrgb&w=600',
//         title: 'Beach House',
//         location: 'Miami, FL',
//         price: '$950,000',
//         type: 'House',
//         description: 'Enjoy the ocean breeze from this beautiful beach house in Miami. The house includes 3 bedrooms, 2 bathrooms, and a private pool.'
//     },

// ];

// // Function to display properties
// function displayProperties(propertyList) {
//     const propertyListContainer = document.getElementById('property-list');
//     propertyListContainer.innerHTML = '';

//     propertyList.forEach((property, index) => {
//         const propertyCard = `
//             <div class="property-card" onclick="openModal(${index})">
//                 <img src="${property.image}" alt="${property.title}">
//                 <div class="property-details">
//                     <h3>${property.title}</h3>
//                     <p>${property.location}</p>
//                     <span>${property.price}</span>
//                 </div>
//             </div>
//         `;
//         propertyListContainer.innerHTML += propertyCard;
//     });
// }

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


// Function to open the modal with property details
function openModal(index) {
    const property = properties[index];
    const modalDetails = document.getElementById('modal-details');

    modalDetails.innerHTML = `
        <img src="${property.image}" alt="${property.title}" style="width: 100%; height: auto; border-radius: 5px;">
        <h2>${property.title}</h2>
        <p><strong>Location:</strong> ${property.location}</p>
        <p><strong>Price:</strong> ${property.price}</p>
        <p><strong>Type:</strong> ${property.type}</p>
        <p>${property.description}</p>
        <button class="contact-btn" onclick="contactAgent('${property.contactEmail}')">Make An Enquiry</button>

    `;

    document.getElementById('property-modal').style.display = 'block';
}

// Function to close the modal
function closeModal() {
    document.getElementById('property-modal').style.display = 'none';
}
function contactAgent(email) {
    // Simulate sending an email
    setTimeout(() => {
        const modalDetails = document.getElementById('modal-details');
        modalDetails.innerHTML = `
            <h2>Enquiry Sent Successfully</h2>
            <p>Thank you for your interest. The agent will contact you shortly.</p>
            <button class="close-modal-btn" onclick="closeModal()">Close</button>
        `;
    }, 500); // Simulate a delay
}

// Function to close the modal
function closeModal() {
    document.getElementById('property-modal').style.display = 'none';
}

// Initial display of properties
// displayProperties(properties);

