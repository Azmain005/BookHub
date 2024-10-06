<?php
session_start();
include 'db_connection.php';  // Make sure to include your DB connection

// Retrieve the submitted email and password
$email = $_POST['email'];
$password = $_POST['password'];

// Query the database for the user
$sql = "SELECT * FROM user WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // User found, verify the password
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        // Password is correct, set session variables
        $_SESSION['username'] = $user['name'];
        $_SESSION['email'] = $user['email'];

        // Redirect to profile page
        header("Location: index.php");
        exit();
    } else {
        // Incorrect password
        $_SESSION['error'] = "Invalid password. Please try again.";
        header("Location: login.php");
        exit();
    }
} else {
    // No user found with this email
    $_SESSION['error'] = "No account found with that email.";
    header("Location: login.php");
    exit();
}
?>