<?php
session_start(); // Start session only once, at the beginning
include 'db_connection.php'; // Include your DB connection

if (!isset($_SESSION['email'])) {
    // Redirect to login if user is not logged in
    header('Location: login.php');
    exit();
}

$email = $_SESSION['email']; // Email is the primary key

// Fetch user data from the database
$query = "SELECT * FROM user WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

$user = $result->fetch_assoc();

// Handle null values (in case some fields are null)
$name = $user['name'] ?? '';
$dob = $user['date_of_birth'] ?? '';
$gender = $user['gender'] ?? '';
$mobile = $user['phone_number'] ?? '';
$address = $user['address'] ?? '';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BookHub</title>
    <link href="https://api.fontshare.com/v2/css?f[]=archivo@100,300,400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="styles/style.css" />
    <link rel="stylesheet" href="styles/utils.css" />
    <link rel="stylesheet" href="styles/modern-normalize.css" />
    <link rel="stylesheet" href="styles/hero.css" />
    <link rel="stylesheet" href="styles/nav2.css" />
    <link rel="stylesheet" href="styles/footer.css" />
    <link rel="stylesheet" href="styles/mainsec.css" />
    <link rel="stylesheet" href="styles/majh.css" />
    <link rel="stylesheet" href="styles/myprofile.css" />
    <style>
      body {
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

<!-- Profile section -->
<div class="outer">
    <a href="wishlist.php"><button class="wish" id="wishl" type="submit"><i class="fa-solid fa-heart"></i></button></a>
    <div class="myprofile">
        <div class="left">
            <div class="probox">
                <div class="pp"><img src="imgs/user.avif" alt="" /></div>
                <div class="namepb">
                    <h4>Hello,</h4>
                    <h3><?php echo $name ? $name : "BookHub User"; ?></h3> <!-- Show the user's name -->
                </div>
            </div>
            <div class="ptiles">
                <a href="myprofile.php"><div class="ptile">My Account</div></a>
                <a href="myorder.php"><div class="ptile">My Orders</div></a>
                <a href="wishlist.php"><div class="ptile">My Wishlists</div></a>
            </div>
        </div>
        <div class="right">
            <form class="profile-form" action="update_profile.php" method="post">
                <div class="ttype">
                    <h3>Name</h3>
                    <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Your Name" />
                </div>

                <div class="ttype">
                    <h3>Your Date of Birth</h3>
                    <input type="date" name="date_of_birth" value="<?php echo $dob; ?>" />
                </div>

                <div class="ttype">
                    <h3>Gender</h3>
                    <div class="rbutt">
                        <label for="male">
                            Male
                            <input type="radio" name="gender" value="male" id="male" <?php if ($gender == 'male') echo 'checked'; ?> />
                        </label>
                        <label for="female">
                            Female
                            <input type="radio" name="gender" value="female" id="female" <?php if ($gender == 'female') echo 'checked'; ?> />
                        </label>
                    </div>
                </div>

                <button class="pbtn save-info" type="submit" name="save_info">Save</button>

                <div class="rline"></div>

                <div class="ttype">
                    <h3>Mobile number</h3>
                    <input type="text" name="mobile" value="<?php echo $mobile; ?>" placeholder="Your Number" />
                </div>

                <button class="pbtn save-mobile" type="submit" name="save_mobile">Save</button>

                <div class="rline"></div>

                <div class="ttype">
                    <h3>Address</h3>
                    <input type="text" name="address" value="<?php echo $address; ?>" placeholder="Your Address" />
                </div>

                <button class="pbtn save-address" type="submit" name="save_address">Save</button>

                <div class="rline"></div>

                <div class="ttype">
                    <h3>Email Address</h3>
                    <input type="email" name="email" value="<?php echo $email; ?>" readonly />
                </div>

                <div class="rline"></div>

                <div class="ttype">
                    <h3>Password</h3>
                    <input type="password" name="password" placeholder="Enter New Password" />
                </div>

                <button class="pbtn save-password" type="submit" name="save_password">Save</button>
            </form>
        </div>
    </div>
</div>
<!-- Profile section ends -->

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
