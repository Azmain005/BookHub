<?php
session_start();
require_once 'db_connection.php'; // Your database connection file

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Get the user's email
$user_email = $_SESSION['email'];

// Handle book removal (Trash button)
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['remove']) && isset($_POST['isbn'])) {
    $isbn = $_POST['isbn'];

    // Delete the book from the cart
    $delete_query = "DELETE FROM ordered_book WHERE email = ? AND isbn = ? AND confirm = 0";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("ss", $user_email, $isbn);
    $stmt->execute();
    $stmt->close();

    header("Location: product_cart.php");
    exit();
}

// Fetch the books from the cart for this user
$query = "SELECT ob.isbn, ob.quantity, b.title, b.price, b.img1, b.quantity as stock FROM ordered_book ob 
          JOIN book b ON ob.isbn = b.isbn 
          WHERE ob.email = ? AND ob.confirm = 0";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();
$cart_books = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Initialize subtotal
$subtotal = 0;

// Handle the "Buy Now" functionality
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['buy_now'])) {
    $selected_books = $_POST['selected_books'] ?? [];

    if (!empty($selected_books)) {
        // Begin transaction
        $conn->begin_transaction();

        try {
            foreach ($selected_books as $isbn) {
                // Validate quantity from POST
                if (!isset($_POST['quantity'][$isbn]) || intval($_POST['quantity'][$isbn]) <= 0) {
                    throw new Exception("Invalid quantity for ISBN: $isbn");
                }

                $new_quantity = intval($_POST['quantity'][$isbn]);

                // Fetch the book data to ensure up-to-date stock
                $query = "SELECT ob.quantity, b.price, b.quantity as stock FROM ordered_book ob 
                          JOIN book b ON ob.isbn = b.isbn 
                          WHERE ob.email = ? AND ob.isbn = ? AND ob.confirm = 0";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ss", $user_email, $isbn);
                $stmt->execute();
                $book_data = $stmt->get_result()->fetch_assoc();
                $stmt->close();

                if ($book_data) {
                    $stock = intval($book_data['stock']);
                    if ($new_quantity <= $stock) {
                        // Update stock in the `book` table
                        $new_stock = $stock - $new_quantity;
                        $update_stock_query = "UPDATE book SET quantity = ? WHERE isbn = ?";
                        $stmt = $conn->prepare($update_stock_query);
                        $stmt->bind_param("is", $new_stock, $isbn);
                        $stmt->execute();
                        $stmt->close();

                        // Calculate total amount (price * quantity)
                        $total_amount = $new_quantity * floatval($book_data['price']);

                        // Update ordered_book with total_amount and confirm
                        $update_order_query = "UPDATE ordered_book SET confirm = 1, total_amount = ?, quantity = ? WHERE email = ? AND isbn = ?";
                        $stmt = $conn->prepare($update_order_query);
                        $stmt->bind_param("diss", $total_amount, $new_quantity, $user_email, $isbn);
                        $stmt->execute();
                        $stmt->close();
                    } else {
                        // Rollback and show error if stock is insufficient
                        $conn->rollback();
                        header("Location: product_cart.php?error=insufficient_stock&isbn=$isbn");
                        exit();
                    }
                } else {
                    // Rollback if book data is not found
                    $conn->rollback();
                    throw new Exception("Book data not found for ISBN: $isbn");
                }
            }

            // Commit transaction
            $conn->commit();
            header("Location: product_cart.php?success=order_confirmed");
            exit();
        } catch (Exception $e) {
            $conn->rollback();
            header("Location: product_cart.php?error=transaction_failed&message=" . $e->getMessage());
            exit();
        }
    } else {
        header("Location: product_cart.php?error=no_books_selected");
        exit();
    }
}
?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BookHub</title>
    <link
      href="https://api.fontshare.com/v2/css?f[]=archivo@100,300,400,500,600,700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0"
    />

    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
    <link rel="stylesheet" href="styles/style.css" />
    <link rel="stylesheet" href="styles/utils.css" />
    <link rel="stylesheet" href="styles/modern-normalize.css" />
    <link rel="stylesheet" href="styles/hero.css" />
    <link rel="stylesheet" href="styles/nav2.css" />
    <link rel="stylesheet" href="styles/footer.css" />
    <link rel="stylesheet" href="styles/mainsec.css" />
    <link rel="stylesheet" href="styles/majh.css" />
    <link rel="stylesheet" href="styles/product_cart.css" />
    <link rel="stylesheet" href="styles/book_desc.css" />
    <style>
      body {
        /* background-image: url("imgs/bg.jpg"); */
        background-repeat: no-repeat;
        background-size: 100%;
        background-color: var(--clr-bg);
      }
    </style>
  </head>
  <body>
  <div class="hero">
    <nav class="navh">
    <a href="index.php">
      <div class="logof">
        <img src="imgs/logo.png" class="logo" /> <span>BookHub</span>
      </div>
    </a>

    <div class="search">
      <div class="search-bar">
        <input type="text" />
      </div>
      <div class="search-icon">
        <a href="#" class="sicon"><i class="fa-solid fa-magnifying-glass"></i></a>
      </div>
    </div>

    <div class="my-profile" onclick="toggleMenu()">
      <p>My Profile</p>
    </div>

    <div class="submenu-wrap" id="subMenu">
      <div class="submenu">
        <div class="user-info">
          <?php
            // session_start();
            if (isset($_SESSION['username'])) {
              // If user is logged in, display the username and logout button
              echo '<h3 class="subproinf">Welcome, ' . $_SESSION['username'] . '</h3>';
              echo '<a href="logout.php" class="ubtn sbtn">Logout</a>';
            } else {
              // If user is not logged in, display sign in and sign up options
              echo '<button class="ubtn sbtn" id="signInButton">Sign in</button>';
              echo '<h3 class="info"><a class="butt" href="login.php">New To BookHub? Sign Up</a></h3>';
            }
          ?>
        </div>
        <hr />
        <a href="myprofile.php" class="sub-menu-link">
          <p>Your Account</p>
          <span>></span>
        </a>
        <a href="myprofile.php" class="sub-menu-link">
          <p>Personal Settings</p>
          <span>></span>
        </a>
        <a href="myorder.php" class="sub-menu-link">
          <p>Your Orders</p>
          <span>></span>
        </a>
        <a href="wishlist.php" class="sub-menu-link">
          <p>Your Wishlist</p>
          <span>></span>
        </a>
        <a href="myprofile.php" class="sub-menu-link">
          <p>Change Password</p>
          <span>></span>
        </a>
      </div>
    </div>

    <div class="cart">
      <a href="product_cart.php">
        <i class="fa-solid fa-cart-shopping"></i>
      </a>
    </div>
  </nav>

  <div class="linediv"></div>
  <div class="nav2">
    <ul class="infos">
      <a href="viewall.php"><li class="binf">All</li></a>
      <div class="vline"></div>
      <a href="viewall.php"><li class="binf">Academics</li></a>
      <div class="vline"></div>
      <a href="viewall.php"><li class="binf">Fiction</li></a>
      <div class="vline"></div>
      <a href="viewall.php"><li class="binf">Non Fiction</li></a>
      <div class="vline"></div>
      <a href="viewall.php"><li class="binf">Children</li></a>
      <div class="vline"></div>
      <a href="viewall.php"><li class="binf">Comics</li></a>
    </ul>
  </div>
  <div class="linediv"></div>
  </div>
<!-- product cart er shuru -->
<div class="pcart">
    <div class="promatha"><h1>MY Cart:</h1></div>
    <div class="ppcart">
        <div class="bam" style="width: 1500px;">
            <?php if (!empty($cart_books)): ?>
                <form method="POST" action="product_cart.php">
                    <?php foreach ($cart_books as $book): 
                        $total_price = $book['price'] * $book['quantity'];
                        $subtotal += $total_price;
                    ?>
                        <div class="prod">
                            <!-- Checkbox to select books -->
                            <input type="checkbox" name="selected_books[]" value="<?php echo $book['isbn']; ?>" checked />

                            <!-- Book Image -->
                            <img src="<?php echo htmlspecialchars($book['img1']); ?>" alt="<?php echo htmlspecialchars($book['title']); ?>" />

                            <!-- Book Information -->
                            <div class="proinfo">
                                <h2><?php echo htmlspecialchars($book['title']); ?></h2>
                                <h3>Price: <?php echo htmlspecialchars($book['price']); ?> Tk</h3>
                                <div class="delandwish">
                                    <button type="button" class="trash-can" data-isbn="<?php echo $book['isbn']; ?>"><i class="fa-regular fa-trash-can"></i></button>
                                </div>
                            </div>

                            <!-- Quantity Modification -->
                            <div class="pquantity">
                                <button type="button" class="pqbtn pminus" onclick="updateQuantity('<?php echo $book['isbn']; ?>', -1)">-</button>
                                <input type="number" id="quantity-<?php echo $book['isbn']; ?>" name="quantity[<?php echo $book['isbn']; ?>]" value="<?php echo htmlspecialchars($book['quantity']); ?>" min="1" max="<?php echo htmlspecialchars($book['stock']); ?>" />
                                <button type="button" class="pqbtn pplus" onclick="updateQuantity('<?php echo $book['isbn']; ?>', 1)">+</button>
                            </div>

                            <!-- Price Calculation -->
                            <h2 class="price" data-isbn="<?php echo $book['isbn']; ?>" data-base-price="<?php echo $book['price']; ?>">
                                Tk <?php echo $total_price; ?>
                            </h2>
                        </div>
                    <?php endforeach; ?>

                    <!-- Checkout Summary -->
                    <div class="checkout">
                        <div class="subtotal">
                            <h2>Checkout Summary</h2>
                            <div class="pline"></div>
                            <div class="st">
                                <h3>Subtotal</h3>
                                <p><?php echo $subtotal; ?> Tk</p>
                            </div>
                            <div class="pline"></div>
                            <div class="st">
                                <h3>Shipping</h3>
                                <p>100 Tk</p>
                            </div>
                            <div class="pline"></div>
                            <div class="st">
                                <h3>Total</h3>
                                <p><?php echo $subtotal + 100; ?> Tk</p>
                            </div>
                        </div>
                        <button style="height: 50px; width: 100%; background-color: var(--clr-gray); color: var(--clr-white); margin-top: 20px; font-size: x-large; border-radius: 5px;" 
                                onmouseover="this.style.color='var(--clr-orange)';" 
                                onmouseout="this.style.color='var(--clr-white)';" name="buy_now" type="submit">
                            Buy Now
                        </button>
                    </div>
                </form>
            <?php else: ?>
                <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 450px; width: 100%">
    <img src="imgs/icon_empty_cart.png" alt="" style="height: 200px; width: 200px;">
    <h2>Your Cart is Empty!</h2></div>
            <?php endif; ?>
        </div>
    </div>
</div>


    <!-- product cart er shesh -->

    <div class="footer-section">
      <div class="shobjinish">
        <div class="item">
          <h2>Top Genre</h2>
          <ul>
            <li class="key"><a href="#">Academic</a></li>
            <li class="key"><a href="#">Fiction</a></li>
            <li class="key"><a href="#">Non Fiction</a></li>
            <li class="key"><a href="#">Children</a></li>
            <li class="key"><a href="#">Comics</a></li>
          </ul>
        </div>
        <div class="item">
          <h2>Quick Links</h2>
          <ul>
            <li class="key"><a href="#">Best Sellers</a></li>
            <li class="key"><a href="#">New Arrivals</a></li>
            <li class="key"><a href="#">Blog</a></li>
          </ul>
        </div>
        <div class="item">
          <h2>Company</h2>
          <ul>
            <li class="key"><a href="#">About Us</a></li>
            <li class="key"><a href="#">Our Technology</a></li>
          </ul>
        </div>
        <div class="item">
          <h2>Help & Support</h2>
          <ul>
            <li class="key"><a href="#">Contact Us</a></li>
            <li class="key"><a href="#">Track Orders</a></li>
            <li class="key"><a href="#">Terms & Conditions</a></li>
            <li class="key"><a href="#">Privacy Policy</a></li>
            <li class="key"><a href="#">Refund & Return</a></li>
          </ul>
        </div>
        <div class="item">
          <h2>Top Authors</h2>
          <ul>
            <li class="key"><a href="#">Joseph Murphy</a></li>
            <li class="key"><a href="#">Leonel Messi</a></li>
            <li class="key"><a href="#">CR7</a></li>
            <li class="key"><a href="#">Mbappe</a></li>
            <li class="key"><a href="#">Kante</a></li>
          </ul>
        </div>
        <div class="item">
          <h2>Top Publishers</h2>
          <ul>
            <li class="key"><a href="#">Prothoma</a></li>
            <li class="key"><a href="#">Boi Bichitra</a></li>
            <li class="key"><a href="#">Batighar</a></li>
            <li class="key"><a href="#">Notion Press</a></li>
            <li class="key"><a href="#">Penguin</a></li>
          </ul>
        </div>
      </div>
      <div class="shob-icon">
        <div class="socicon">
          <a href="#"><i class="fa-brands fa-facebook"></i></a>
        </div>
        <div class="socicon">
          <a href="#"><i class="fa-brands fa-instagram"></i></a>
        </div>
        <div class="socicon">
          <a href="#"><i class="fa-brands fa-github"></i></a>
        </div>
        <div class="socicon">
          <a href="#"><i class="fa-brands fa-linkedin"></i></a>
        </div>
      </div>
      <div class="rights">
        Copyright © 2024 . Team KichuEkta. All Rights Reserved
      </div>
    </div>
    <script src="src/main.js"></script>
    <script src="src/login.js"></script>
    <script src="src/emptycart.js"></script>
    <script src="src/desc.js"></script>
    <!-- <script src="src/productcart.js"></script> -->
    <script src="src/profile.js"></script>
    <script src="src/seller.js"></script>
    <script src="src/wish.js"></script>
    <!-- Inline JavaScript to handle the quantity changes -->

<script>
    function updateQuantity(isbn, change) {
        const quantityField = document.getElementById('quantity-' + isbn);
        let currentQuantity = parseInt(quantityField.value);
        let maxQuantity = parseInt(quantityField.max);

        if (change === -1 && currentQuantity > 1) {
            quantityField.value = currentQuantity - 1;
        } else if (change === 1 && currentQuantity < maxQuantity) {
            quantityField.value = currentQuantity + 1;
        }
    }
</script>
    <!-- JavaScript to handle trash can button click -->
<script>
    // Function to update quantity and price dynamically
    function updateQuantity(isbn, quantityInput, operation) {
        const quantity = parseInt(quantityInput.value);
        const maxStock = parseInt(quantityInput.getAttribute('max'));
        let newQuantity = operation === 'increase' ? quantity + 1 : quantity - 1;

        if (newQuantity < 1) newQuantity = 1; // Prevent going below 1
        if (newQuantity > maxStock) newQuantity = maxStock; // Prevent going beyond available stock

        quantityInput.value = newQuantity;
        updatePrice(isbn, newQuantity); // Update price based on new quantity
    }

    // Update the price for a specific book and recalculate totals
    function updatePrice(isbn, newQuantity) {
        const priceElement = document.querySelector(`.price[data-isbn='${isbn}']`);
        const basePrice = parseFloat(priceElement.getAttribute('data-base-price'));
        const newPrice = newQuantity * basePrice;

        priceElement.innerText = `Tk ${newPrice.toFixed(2)}`;

        calculateSummary(); // Update subtotal and total in real-time
    }

    // Recalculate subtotal, shipping, and total based on checked items and quantities
    function calculateSummary() {
        let subtotal = 0;
        const selectedBooks = document.querySelectorAll("input[name='selected_books[]']:checked");

        selectedBooks.forEach(function (checkbox) {
            const isbn = checkbox.value;
            const quantity = parseInt(document.querySelector(`input[name='quantity'][data-isbn='${isbn}']`).value);
            const price = parseFloat(document.querySelector(`.price[data-isbn='${isbn}']`).getAttribute('data-base-price'));

            subtotal += (price * quantity);
        });

        document.querySelector(".st p").innerText = `${subtotal.toFixed(2)} Tk`;
        document.querySelector(".total p").innerText = `${(subtotal + 100).toFixed(2)} Tk`; // Assuming 100 Tk shipping
    }

    // Event listeners for quantity buttons
    document.querySelectorAll(".pminus").forEach(function (button) {
        button.addEventListener("click", function () {
            const isbn = this.getAttribute('data-isbn');
            const quantityInput = document.querySelector(`input[name='quantity'][data-isbn='${isbn}']`);
            updateQuantity(isbn, quantityInput, 'decrease');
        });
    });

    document.querySelectorAll(".pplus").forEach(function (button) {
        button.addEventListener("click", function () {
            const isbn = this.getAttribute('data-isbn');
            const quantityInput = document.querySelector(`input[name='quantity'][data-isbn='${isbn}']`);
            updateQuantity(isbn, quantityInput, 'increase');
        });
    });

    // Event listener for checkboxes to recalculate subtotal and total
    document.querySelectorAll("input[name='selected_books[]']").forEach(function (checkbox) {
        checkbox.addEventListener("change", function () {
            calculateSummary();
        });
    });

    // Handle trash can button click for book removal
    document.querySelectorAll('.trash-can').forEach(function (button) {
        button.addEventListener('click', function () {
            const isbn = this.getAttribute('data-isbn');
            fetch('product_cart.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({ 'remove': true, 'isbn': isbn })
            }).then(response => {
                if (response.ok) window.location.reload(); // Reload page after deletion
            }).catch(error => console.error('Error:', error));
        });
    });

    // Call calculateSummary on page load to initialize the totals
    window.onload = function() {
        calculateSummary();
    };
</script>
    <!-- <script src="src/cart.js"></script> -->
  </body>
</html>


<!-- 
                <div class="dan">
          <div class="subtotal">
            <h2>Checkout Summary</h2>
            <div class="pline"></div>
            <div class="st">
              <h3>Subtotal</h3>
              <p>550Tk</p>
            </div>
            <div class="pline"></div>
            <div class="st">
              <h3>Shipping</h3>
              <p>100Tk</p>
            </div>
            <div class="pline"></div>
            <div class="st">
              <h3>Total</h3>
              <p>650Tk</p>
            </div>
          </div>
         <button style="height: 50px; width: 100%; background-color: var(--clr-gray); color: var(--clr-white); margin-top: 20px; font-size: x-large; border-radius: 5px;" 
        onmouseover="this.style.color='var(--clr-orange)';" 
        onmouseout="this.style.color='var(--clr-white)';">
  Buy Now
</button>


        </div> -->




<!-- <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 400px; width: 100%">
    <img src="imgs/icon_empty_cart.png" alt="" style="height: 200px; width: 200px;">
    <h2>Your Cart is Empty!</h2> -->