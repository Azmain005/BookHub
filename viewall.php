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
    <link rel="stylesheet" href="styles/majh.css" />
    <link rel="stylesheet" href="styles/viewall.css" />
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
                session_start();
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

    <!-- view all er shuru -->
    <div class="lulliall">
      <div class="bookcatvall">
        <div class="catnameall">
          <h2>All Books</h2>
        </div>
        <div class="booklineall"></div>
        <div class="book-shelfall">
          <?php
            // Connect to the database
            $conn = new mysqli("localhost", "root", "", "bookhub");

            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }

            // Get books from the database
            $sql = "SELECT * FROM book";
            $result = $conn->query($sql);

            // view all er add to cart

            if ($result->num_rows > 0): 
              while ($row = $result->fetch_assoc()): ?>
                <div class="bookall">
                  <div class="book-imgall">
                    <a href="book_desc.php?isbn=<?php echo $row['isbn']; ?>">
                      <img src="<?php echo $row['img1']; ?>" alt="">
                    </a>
                  </div>
                  <button class="btnall view-detailsall" id="viewdet" type="submit">
                    <a href="book_desc.php?isbn=<?php echo $row['isbn']; ?>">View Details</a>
                  </button>
                  <div class="book-titleall">
                    <h2><?php echo $row['title']; ?></h2>
                    <h3><?php echo $row['author']; ?></h3>
                  </div>
                  <p>Tk <?php echo $row['price']; ?></p>
                  <form action="add_to_cart.php" method="post">
    <input type="hidden" name="isbn" value="<?php echo $row['isbn']; ?>">
    <button class="btnall add-to-cartall" type="submit">Add To Cart</button>
</form>
                </div>
            <?php 
              endwhile;
            endif;
            $conn->close();
          ?>
        </div>
      </div>
    </div>
    <!-- view all er shesh -->

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
    <script src="src/productcart.js"></script>
    <script src="src/profile.js"></script>
    <script src="src/seller.js"></script>
    <script src="src/wish.js"></script>
  </body>
</html>
