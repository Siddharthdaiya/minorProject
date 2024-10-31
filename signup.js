// script.js

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('signupForm');
    const errorMessage = document.getElementById('errorMessage');
    const successMessage = document.getElementById('successMessage');

    form.addEventListener('submit', (e) => {
        e.preventDefault();

        // Get form values
        const username = document.getElementById('username').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        // Simple validation (replace with actual registration logic)
        if (username && email && password) {
            // Hide error message and show success message
            errorMessage.classList.add('hidden');
            successMessage.classList.remove('hidden');

            // Redirect to login page after 2 seconds
            setTimeout(() => {
                window.location.href = 'login.html'; // Replace with the URL of the login page
            }, 2000);
        } else {
            // Hide success message and show error message
            successMessage.classList.add('hidden');
            errorMessage.classList.remove('hidden');
        }
    });
});
