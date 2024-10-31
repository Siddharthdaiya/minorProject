<?php
// Include database configuration file
include 'Admin/config.php'; // Adjust the path as per your folder structure

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];

    // Check if email already exists
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error = "Email already exists!";
    } else {
        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert user data into the database
        $sql = "INSERT INTO users (username, email, password, phone) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $username, $email, $hashedPassword, $phone);

        if ($stmt->execute()) {
            $success = "Account created successfully! You can now login.";
        } else {
            $error = "Error: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Real Estate</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <main class="signup-container">
        <div class="signup-card">
            <h1>Create Account</h1>
            <?php if (isset($error)) { echo "<div class='error'>$error</div>"; } ?>
            <?php if (isset($success)) { echo "<div class='success'>$success</div>"; } ?>

            <form id="signupForm" method="POST" action="signup.php">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
                
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
                
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>

                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" placeholder="Enter your phone number" required>

                <button type="submit">Sign Up</button>
            </form>

            <div class="login-link">
                <p>Already have an account?</p>
                <a href="login.php" class="login-button">Login Here</a>
            </div>
        </div>
    </main>
</body>
</html>
