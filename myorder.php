<?php
session_start();
require_once 'db_connection.php'; // Include your database connection file

// Redirect to login if user is not logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Get the user's email
$user_email = $_SESSION['email'];

// Fetch confirmed orders from ordered_book for the logged-in user
$query = "SELECT ob.isbn, ob.quantity, ob.total_amount, b.title, b.author, b.price, b.img1
          FROM ordered_book ob
          JOIN book b ON ob.isbn = b.isbn
          WHERE ob.email = ? AND ob.confirm = 1";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();
$orders = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Calculate the total amount for all books
$subtotal = 0;
$shipping_cost = 100; // Flat shipping cost
foreach ($orders as $order) {
    $subtotal += $order['total_amount']; // Total amount for each book is already calculated in ordered_book
}
$total_amount = $subtotal + $shipping_cost;

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
    <div class="promatha"><h1>My Orders:</h1></div>
    <div class="ppcart">
        <div class="bam">
            <?php if (!empty($orders)): ?>
                <?php foreach ($orders as $order): ?>
                    <div class="prod">
                        <img src="<?php echo htmlspecialchars($order['img1']); ?>" alt="Book Image"/>
                        <div class="proinfo">
                            <h2><?php echo htmlspecialchars($order['title']); ?></h2>
                            <h3><?php echo htmlspecialchars($order['author']); ?></h3>
                            <h3>Quantity: <?php echo htmlspecialchars($order['quantity']); ?></h3>
                        </div>
                        <h2 class="price">Tk <?php echo htmlspecialchars($order['total_amount']); ?></h2>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 450px; width: 100%">
    <img src="imgs/icon_empty_cart.png" alt="" style="height: 200px; width: 200px;">
    <h1>You Haven't Ordered Any Book!</h1></div>
            <?php endif; ?>
        </div>

        <!-- Box showing the total amount -->
        <div class="dan">
            <div class="subtotal">
                <h2>Total Amount</h2>
                <div class="pline"></div>
                <div class="st">
                    <h3>Subtotal</h3>
                    <p><?php echo htmlspecialchars($subtotal); ?> Tk</p>
                </div>
                <div class="pline"></div>
                <div class="st">
                    <h3>Shipping</h3>
                    <p><?php echo htmlspecialchars($shipping_cost); ?> Tk</p>
                </div>
                <div class="pline"></div>
                <div class="st">
                    <h3>Total</h3>
                    <p><?php echo htmlspecialchars($total_amount); ?> Tk</p>
                </div>
            </div>
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
    <script src="src/productcart.js"></script>
  </body>
</html>
