<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

$email = $_SESSION['email']; // Get the logged-in user's email

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save_info'])) {
        // Update name, dob, and gender
        $name = $_POST['name'];
        $dob = $_POST['date_of_birth'];
        $gender = $_POST['gender'];

        $query = "UPDATE user SET name = ?, date_of_birth = ?, gender = ? WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssss", $name, $dob, $gender, $email);
        $stmt->execute();
    }

    if (isset($_POST['save_mobile'])) {
        // Update mobile number
        $mobile = $_POST['mobile'];

        $query = "UPDATE user SET phone_number = ? WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $mobile, $email);
        $stmt->execute();
    }

    if (isset($_POST['save_address'])) {
        // Update address
        $address = $_POST['address'];

        $query = "UPDATE user SET address = ? WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $address, $email);
        $stmt->execute();
    }

    if (isset($_POST['save_password'])) {
        // Update password
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $query = "UPDATE user SET password = ? WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $password, $email);
        $stmt->execute();
    }

    // Redirect back to profile page after update
    header('Location: myprofile.php');
    exit();
}
?>