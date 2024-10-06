<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection details
$servername = 'localhost';
$username = 'root';
$password = ''; 
$database = 'bookhub'; 

// Create connection
$con = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$con) {
    die('Connection Failed: ' . mysqli_connect_error());
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $title = mysqli_real_escape_string($con, $_POST['bookName']);
    $author = mysqli_real_escape_string($con, $_POST['authorName']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $publisher = mysqli_real_escape_string($con, $_POST['publisher']);
    $language = mysqli_real_escape_string($con, $_POST['language']);
    $isbn = mysqli_real_escape_string($con, $_POST['isbn']);
    $publishing_date = mysqli_real_escape_string($con, $_POST['pubDate']);
    $total_page = mysqli_real_escape_string($con, $_POST['totalPage']);
    $weight = mysqli_real_escape_string($con, $_POST['weight']);
    $category = mysqli_real_escape_string($con, $_POST['Category']);
    $quantity = mysqli_real_escape_string($con, $_POST['Quantity']);
    $description = mysqli_real_escape_string($con, $_POST['description']);

    // File upload handling
    $image1 = $image2 = $image3 = '';
    $upload_dir = 'uploads/'; 
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    if (isset($_FILES['image1']) && $_FILES['image1']['error'] === UPLOAD_ERR_OK) {
        $image1 = $upload_dir . basename($_FILES['image1']['name']);
        move_uploaded_file($_FILES['image1']['tmp_name'], $image1);
    }

    if (isset($_FILES['image2']) && $_FILES['image2']['error'] === UPLOAD_ERR_OK) {
        $image2 = $upload_dir . basename($_FILES['image2']['name']);
        move_uploaded_file($_FILES['image2']['tmp_name'], $image2);
    }

    if (isset($_FILES['image3']) && $_FILES['image3']['error'] === UPLOAD_ERR_OK) {
        $image3 = $upload_dir . basename($_FILES['image3']['name']);
        move_uploaded_file($_FILES['image3']['tmp_name'], $image3);
    }

    //  SQL query
    $sql = "INSERT INTO book (title, author, price, publisher, language, img1, img2, img3, isbn, publishing_date, total_page, weight, category, quantity, description)
            VALUES ('$title', '$author', '$price', '$publisher', '$language', '$image1', '$image2', '$image3', '$isbn', '$publishing_date', '$total_page', '$weight', '$category', '$quantity', '$description')";

    if (mysqli_query($con, $sql)) {
        echo 'Book added successfully!';
    } else {
        echo 'Error: ' . mysqli_error($con);
    }

    // Close connection
    mysqli_close($con);
} else {
    echo 'Invalid request method.';
}
header('location:seller.php');
?>
