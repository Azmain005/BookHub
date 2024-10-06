<?php

session_start();

// Connect to the database
$conn = new mysqli("localhost", "root", "", "bookhub");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (!isset($_SESSION['email'])) {
    header("Location: login.php"); 
    exit();
}

//logged-in user's email
$user_email = $_SESSION['email'];

// Get the ISBN from the URL
$isbn = isset($_GET['isbn']) ? $_GET['isbn'] : '';
$book = null;
$book_images = []; 

if (!empty($isbn)) {
    // Fetch the book details using the ISBN
    $stmt = $conn->prepare("SELECT * FROM book WHERE isbn = ?");
    $stmt->bind_param("s", $isbn);
    $stmt->execute();
    $result = $stmt->get_result();
    $book = $result->fetch_assoc();
    $stmt->close();

    if ($book) {
        $book_images = [
            'image1' => $book['img1'],
            'image2' => $book['img2'] ?? null,
            'image3' => $book['img3'] ?? null,
        ];
    }
}

// wishlist form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_wishlist'])) {
    // Insert the book's ISBN and user's email into the wishlist table
    $stmt = $conn->prepare("INSERT INTO wishlist (isbn, email) VALUES (?, ?)");
    $stmt->bind_param("ss", $isbn, $user_email);

    if ($stmt->execute()) {
        $wishlist_message = "Book added to wishlist!";
    } else {
        $wishlist_message = "Failed to add book to wishlist!";
    }
    $stmt->close();
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details - <?php echo htmlspecialchars($book['title'] ?? 'Unknown Book'); ?></title>
    
    <!-- CSS and Font Links -->
    <link href="https://api.fontshare.com/v2/css?f[]=archivo@100,300,400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/utils.css">
    <link rel="stylesheet" href="styles/modern-normalize.css">
    <link rel="stylesheet" href="styles/hero.css">
    <link rel="stylesheet" href="styles/nav2.css">
    <link rel="stylesheet" href="styles/footer.css">
    <link rel="stylesheet" href="styles/mainsec.css">
    <link rel="stylesheet" href="styles/majh.css">
    <link rel="stylesheet" href="styles/book_desc.css">
    <style>
        body {
            background-color: var(--clr-bg);
        }
        .pic {
            height: 95%;
            width: 95%;
            border: 2px solid black;
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body>
    <div class="hero">
        <!-- Navigation Bar -->
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
                        if (isset($_SESSION['username'])) {
                            echo '<h3 class="subproinf">Welcome, ' . $_SESSION['username'] . '</h3>';
                            echo '<a href="logout.php" class="ubtn sbtn">Logout</a>';
                        } else {
                            echo '<button class="ubtn sbtn" id="signInButton">Sign in</button>';
                            echo '<h3 class="info"><a class="butt" href="login.php">New To BookHub? Sign Up</a></h3>';
                        }
                        ?>
                    </div>
                    <hr />
                    <a href="myprofile.php" class="sub-menu-link"><p>Your Account</p></a>
                    <a href="myprofile.php" class="sub-menu-link"><p>Personal Settings</p></a>
                    <a href="myorder.php" class="sub-menu-link"><p>Your Orders</p></a>
                    <a href="wishlist.php" class="sub-menu-link"><p>Your Wishlist</p></a>
                    <a href="myprofile.php" class="sub-menu-link"><p>Change Password</p></a>
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

    <!-- Book Description Section -->
    <div class="nothing_emni">
    <div class="boiyer-chobi">
        <div class="minimap">
            <?php foreach ($book_images as $key => $image): ?>
                <?php if ($image): ?>
                    <div class="minibook" data-image="<?php echo htmlspecialchars($image); ?>">
                        <div class="picbook">
                            <img src="<?php echo htmlspecialchars($image); ?>" alt="Book Image">
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <div class="bookpic">
            <div class="pic" id="pic" style="background-image: url('<?php echo htmlspecialchars($book['img1']); ?>');"></div>

            
            <!-- Wishlist Button Form -->
            <form method="POST" action="">
                <button class="wishlist" id="wishlistButton" name="add_to_wishlist" type="submit">
                    <i class="fa-regular fa-heart"></i>
                </button>
            </form>
        </div>
    </div>

    <div class="boiyer-info">
        <div class="bookname">
            <h2><?php echo htmlspecialchars($book['title']); ?></h2>
            By <a href="#"><?php echo htmlspecialchars($book['author']); ?></a>
        </div>
        <div class="lang"><?php echo htmlspecialchars($book['language'] ?? 'English'); ?></div>
        <div class="descline"></div>

        <div class="type">
            <h2>Paperback</h2>
            <h3>&#x9F3 <?php echo htmlspecialchars($book['price']); ?></h3>
        </div>
        <form action="add_to_cart.php" method="post">
            <input type="hidden" name="isbn" value="<?php echo $book['isbn']; ?>">
            <button class="acbtn" type="submit">Add To Cart</button>
        </form>
        <div class="descline"></div>
        <div class="privacytags">
            <div class="tags">
                <img src="imgs/p1.svg" alt="">
                <p>Piracy-free</p>
            </div>
            <div class="tags">
                <img src="imgs/p2.svg" alt="">
                <p>Assured Quality</p>
            </div>
            <div class="tags">
                <img src="imgs/p3.svg" alt="">
                <p>Secure Transactions</p>
            </div>
            <div class="tags">
                <img src="imgs/p4.svg" alt="">
                <p>Fast Delivery</p>
            </div>
            <div class="tags">
                <img src="imgs/p5.svg" alt="">
                <p>Sustainably Printed</p>
            </div>
        </div>
        <div class="descline"></div>
        <p>*COD & Shipping Charges may apply on checkout</p>
    </div>
</div>

<div class="details">
    <div class="det">
        <h2>Details:</h2>
        <ul>
            <li><h3>ISBN 13</h3>- <p><?php echo nl2br(htmlspecialchars($book['isbn'])); ?></p></li>
            <li><h3>Publication Date</h3>- <p><?php echo nl2br(htmlspecialchars($book['publishing_date'])); ?></p></li>
            <li><h3>Pages</h3>- <p><?php echo nl2br(htmlspecialchars($book['total_page'])); ?></p></li>
            <li><h3>Weight</h3>- <p><?php echo nl2br(htmlspecialchars($book['weight'])); ?></p> grams</li>
            <li><h3>Category</h3>- <p><?php echo nl2br(htmlspecialchars($book['category'])); ?></p></li>
            <li><h3>Publisher</h3>-  <a href="#"> <p><?php echo nl2br(htmlspecialchars($book['publisher'])); ?></p></a></li>
        </ul>
    </div>
</div>

<div class="about" style="height: auto; margin-bottom: 10px">
    <div class="ab" style="height: auto;">
        <h1>About The Book</h1>
        <h2>Description</h2>
        <p><?php echo nl2br(htmlspecialchars($book['description'])); ?></p>
    </div>
</div>
<?php if (isset($wishlist_message)): ?>
    <p><?php echo $wishlist_message; ?></p>
<?php endif; ?>
    <!-- book desc er shesh -->

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
    <script src="src/desc.js"></script>
    <script src="src/main.js"></script>

  </body>
</html>
