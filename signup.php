<?php
// Database connection
$servername = "localhost"; // Change if needed
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "bookhub"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// Hash the password for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO user (name, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $hashed_password);

// Execute and check for success
if ($stmt->execute()) {
    // Redirect to login.php after successful signup
    header("Location: login.php");
    exit(); // Always call exit after a redirect
} else {
    echo "Error: " . $stmt->error;
    // header("location: seller.php");
}

// Close connections
$stmt->close();
$conn->close();
?>
