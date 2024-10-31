document.getElementById('propertyForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission behavior

    // Get form values
    const name = document.getElementById('name').value;
    const price = document.getElementById('price').value;
    const address = document.getElementById('address').value;
    const sellupto = document.getElementById('sellupto').value;
    const imageFile = document.getElementById('image').files[0]; // Get the image file
    const sqft = document.getElementById('sqft').value;
    const contactno = document.getElementById('contactno').value;
    const email = document.getElementById('email').value;

    // Create a FormData object to handle file uploads
    const formData = new FormData();
    formData.append('name', name);
    formData.append('price', price);
    formData.append('address', address);
    formData.append('sellupto', sellupto);
    formData.append('image', imageFile);
    formData.append('sqft', sqft);
    formData.append('contactno', contactno);
    formData.append('email', email);

    // Create a property card element
    const propertyCard = document.createElement('div');
    propertyCard.className = 'property-card';

    // Create image element
    const propertyImage = document.createElement('div');
    propertyImage.className = 'property-image';
    const imgElement = document.createElement('img');
    imgElement.src = URL.createObjectURL(imageFile); // Create a URL for the uploaded image
    propertyImage.appendChild(imgElement);

    // Create details element
    const propertyDetails = document.createElement('div');
    propertyDetails.className = 'property-details';
    propertyDetails.innerHTML = `
        <h3>${name}</h3>
        <p>Address: ${address}</p>
        <p>Price: ₹${price}</p>
        <p>Square Feet: ${sqft} sqft</p>
        <p>Contact: ${contactno}</p>
        <p>Email: ${email}</p>
        <p>Sell Up To: ${sellupto}</p>
    `;

    // Append image and details to the card
    propertyCard.appendChild(propertyImage);
    propertyCard.appendChild(propertyDetails);

    // Append the card to the properties list
    document.getElementById('propertiesList').appendChild(propertyCard);

    // Reset the form fields after submission
    this.reset();
});
