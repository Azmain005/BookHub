
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
    <link rel="stylesheet" href="styles/seller.css" />
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
        <a href="index.php"
          ><div class="logof">
            <img src="imgs/logo.png" class="logo" /> <span>BookHub</span>
          </div></a
        >

        <div class="search">
          <div class="search-bar">
            <input type="text" />
          </div>
          <div class="search-icon">
            <a href="#" class="sicon"
              ><i class="fa-solid fa-magnifying-glass"></i
            ></a>
          </div>
        </div>
        <div class="my-profile" onclick="toggleMenu()">
          <p>My Profile</p>
        </div>
        <div class="submenu-wrap" id="subMenu">
          <div class="submenu">
            <div class="user-info">
              <!-- logout kora thakle -->
              <button class="ubtn sbtn" id="signInButton">Sign in</button>
              <h3 class="info">
                <a class="butt" href="login.php">New To BookHub? Sign Up</a>
              </h3>
              <!-- logout kora thakle -->
               <!-- logout kora na thakle -->
                <!-- <h3 class="subproinf">Welcome, Md. Azmain Adib</h3> -->
                <!-- logout kora na thakle -->
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
            <a href="#" class="sub-menu-link">
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
          <a href="viewall.php"><li class="binf">Non Ficton</li></a>
          <div class="vline"></div>
          <a href="viewall.php"><li class="binf">Children</li></a>
          <div class="vline"></div>
          <a href="viewall.php"><li class="binf">Comics</li></a>
        </ul>
      </div>
      <div class="linediv"></div>
    </div>
    
<!-- seller er shuru -->
<form class="seller" action="addBook.php" method="post" enctype="multipart/form-data">
  <div class="sell">
    <h1>Add Books</h1>
    <div class="bline"></div>

    <div class="form-group">
      <label for="bookName">Book Name:</label>
      <input id="bookName" type="text" name="bookName" required />
    </div>
    <div class="bline"></div>

    <div class="form-group">
      <label for="authorName">Author Name:</label>
      <input id="authorName" type="text" name="authorName" required />
    </div>
    <div class="bline"></div>

    <div class="form-group">
      <label for="price">Price:</label>
      <input id="price" type="text" name="price" required />
    </div>
    <div class="bline"></div>

    <div class="form-group">
      <label for="publisher">Publisher:</label>
      <input id="publisher" type="text" name="publisher" required />
    </div>
    <div class="bline"></div>

    <div class="form-group">
      <label for="language">Language:</label>
      <input id="language" type="text" name="language" required />
    </div>
    <div class="bline"></div>

    <div class="form-group">
      <label for="image1">Image 1:</label>
      <div class="file-input">
        <input
          id="image1Text"
          type="text"
          placeholder="No file chosen"
          readonly
        />
        <label for="image1File" class="choose-file">Choose File</label>
        <input
          id="image1File"
          type="file"
          name="image1"
          accept="image/*"
          style="display: none"
          required
        />
      </div>
    </div>
    <div class="bline"></div>

    <div class="form-group">
      <label for="image2">Image 2:</label>
      <div class="file-input">
        <input
          id="image2Text"
          type="text"
          placeholder="No file chosen"
          readonly
        />
        <label for="image2File" class="choose-file">Choose File</label>
        <input
          id="image2File"
          type="file"
          name="image2"
          accept="image/*"
          style="display: none"
        />
      </div>
    </div>
    <div class="bline"></div>

    <div class="form-group">
      <label for="image3">Image 3:</label>
      <div class="file-input">
        <input
          id="image3Text"
          type="text"
          placeholder="No file chosen"
          readonly
        />
        <label for="image3File" class="choose-file">Choose File</label>
        <input
          id="image3File"
          type="file"
          name="image3"
          accept="image/*"
          style="display: none"
        />
      </div>
    </div>
    <div class="bline"></div>

    <div class="form-group">
      <label for="isbn">ISBN:</label>
      <input id="isbn" type="text" name="isbn" required />
    </div>
    <div class="bline"></div>

    <div class="form-group">
      <label for="pubDate">Publication Date:</label>
      <input id="pubDate" type="date" name="pubDate" required />
    </div>
    <div class="bline"></div>

    <div class="form-group">
      <label for="totalPage">Total Page:</label>
      <input id="totalPage" type="text" name="totalPage" required />
    </div>
    <div class="bline"></div>

    <div class="form-group">
      <label for="weight">Weight:</label>
      <input id="weight" type="text" name="weight" required />
    </div>
    <div class="bline"></div>

    <div class="form-group">
      <label for="Category">Category:</label>
      <input id="Category" type="text" name="Category" required />
    </div>
    <div class="bline"></div>

    <div class="form-group">
      <label for="Quantity">Quantity:</label>
      <input id="Quantity" type="text" name="Quantity" required />
    </div>
    <div class="bline"></div>

    <div class="form-group">
      <label for="description">Description:</label>
      <textarea id="description" name="description" class="large-input" required></textarea>
    </div>
    <div class="bline"></div>

    <button type="submit" class="sellbtn">Add Book</button>
  </div>
</form>


<!-- seller er shesh -->
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
    <script>
  document.querySelector('.seller').addEventListener('submit', function(event) {
    let valid = true;
    let fields = document.querySelectorAll('.seller input[required], .seller textarea[required]');

    fields.forEach(function(field) {
      if (!field.value) {
        valid = false;
        field.style.borderColor = 'red'; // Highlight empty fields
      } else {
        field.style.borderColor = ''; // Remove highlight
      }
    });

    if (!valid) {
      event.preventDefault(); // Prevent form submission
      alert('Please fill out all required fields.');
    }
  });
</script>

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


