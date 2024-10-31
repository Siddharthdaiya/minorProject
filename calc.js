function calculateMortgage() {
    // Get input values
    const price = parseFloat(document.getElementById('price').value);
    const downpayment = parseFloat(document.getElementById('downpayment').value);
    const interest = parseFloat(document.getElementById('interest').value) / 100 / 12;
    const years = parseFloat(document.getElementById('years').value) * 12;

    // Validate inputs
    if (isNaN(price) || isNaN(downpayment) || isNaN(interest) || isNaN(years)) {
        alert('Please enter valid values.');
        return;
    }

    // Ensure downpayment is less than price
    if (downpayment >= price) {
        alert('Downpayment should be less than the price.');
        return;
    }

    // Handle very low interest rates or zero interest
    if (interest <= 0) {
        alert('Interest rate must be greater than zero.');
        return;
    }

    // Calculate loan amount
    const loanAmount = price - downpayment;

    // Calculate monthly payment using the formula
    const monthlyPayment = (loanAmount * interest) / (1 - Math.pow(1 + interest, -years));

    // Calculate total payment and interest
    const totalPayment = monthlyPayment * years;
    const totalInterest = totalPayment - loanAmount;

    // Format currency in INR
    function formatCurrency(amount) {
        return '₹' + amount.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    // Display results
    const resultsDiv = document.getElementById('results');
    resultsDiv.innerHTML = `
        <h3>Estimated Mortgage Details:</h3>
        <p><strong>Monthly Payment:</strong> ${formatCurrency(monthlyPayment)}</p>
        <p><strong>Total Payment:</strong> ${formatCurrency(totalPayment)}</p>
        <p><strong>Total Interest:</strong> ${formatCurrency(totalInterest)}</p>
    `;

    // Optionally reset the form
    document.getElementById('mortgageForm').reset();
}
