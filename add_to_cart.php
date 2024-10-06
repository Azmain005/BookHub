<?php
session_start();
require_once 'db_connection.php'; // Your database connection file

if (!isset($_SESSION['email'])) {
    // If the user is not logged in, redirect them to the login page
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $isbn = $_POST['isbn'];
    $user_email = $_SESSION['email']; // Assuming the session holds user's email or username

    // Check the stock of the book
    $query = "SELECT quantity FROM book WHERE isbn = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $isbn);
    $stmt->execute();
    $stmt->bind_result($stock);
    $stmt->fetch();
    $stmt->close();

    if ($stock > 0) {
        // Check if the book is already in the user's cart
        $check_query = "SELECT * FROM ordered_book WHERE isbn = ? AND email = ?";
        $stmt = $conn->prepare($check_query);
        $stmt->bind_param("ss", $isbn, $user_email);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows == 0) {
            // Add the book to the cart with quantity = 1
            $insert_query = "INSERT INTO ordered_book (email, isbn, quantity, total_amount, confirm) VALUES (?, ?, 1, 0, 0)";
            $stmt = $conn->prepare($insert_query);
            $stmt->bind_param("ss", $user_email, $isbn);
            $stmt->execute();
            $stmt->close();

            // No stock reduction here, it will be done after Buy Now is clicked in product_cart.php

            // Redirect to cart or success message
            header("Location: product_cart.php?success=1");
            exit();
        } else {
            // If the book is already in the cart, display a message
            header("Location: product_cart.php?error=already_in_cart");
            exit();
        }
    } else {
        // If the book is out of stock, display an error message
        header("Location: viewall.php?error=out_of_stock");
        exit();
    }
}
?>