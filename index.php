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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />

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
            session_start();
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


    <!-- <div class="mainsec">
      <div class="header-slider">
        <a href="#" class="control_prev controller"
          ><i class="fa-solid fa-angles-left"></i
        ></a>
        <a href="#" class="control_next controller"
          ><i class="fa-solid fa-angles-right"></i
        ></a>
        <ul class="ulheader">
          <a href="#" class="nothing"><img src="imgs/one.jpg" class="header-img" /></a>
          <a href="#" class="nothing"><img src="imgs/six.jpg" class="header-img" /></a>
          <a href="#" class="nothing"><img src="imgs/two.jpg" class="header-img" /></a>
          <a href="#" class="nothing"><img src="imgs/three.jpg" class="header-img" /></a>
          <a href="#" class="nothing"er-img" /></a>
          <a href="#" class="nothing"><img src="imgs/five.jpg" class="header-img" /></a>
          <a href="#" class="nothing"><img src="imgs/four.jpg" class="header-img" /></a>
        </ul>
      </div>
    </div> -->
    <div class="majher">
      <div class="filnsearch">

        <div class="sort">
          <div class="sorthead">
            <h2>Sort</h2>
            <a href="#" class="">Reset Sort</a>
          </div>
          <div class="sline"></div>
          <div class="radiobuttons">
            <form class="buttform">
              <label>
                <input type="radio" name="option" value="Best Seller">
                Best Seller
              </label><br>
              
              <label>
                <input type="radio" name="option" value="New Released">
                New Released
              </label><br>
              
              <label>
                <input type="radio" name="option" value="Price - Low to High">
                Price - Low to High
              </label><br>
              <label>
                <input type="radio" name="option" value="Price - High to Low">
                Price - High to Low
              </label><br>
              <label>
                <input type="radio" name="option" value="Discount - Low to High">
                Discount - Low to High
              </label><br>
              <label>
                <input type="radio" name="option" value="Discount - High to Low">
                Discount - High to Low
              </label><br>

            </form>
          </div>
        </div>

        <div class="filter">
          <div class="sorthead">
            <h2>Filter</h2>
            <a href="#" class="">Reset Filter</a>
          </div>
          <div class="sline"></div>

          <div class="category">
            <h3>Category</h3>
            <div class="scat">
              <div class="bar">
                <input type="text" class="barc">
                <div class="sd" style="height: 31px;"><a href="#" class="catcon"
                  ><i class="fa-solid fa-magnifying-glass"></i
                ></a></div>
              </div>
            </div>
            <div class="check-box">
              <label><input type="checkbox" name="bengali_poetry" value="Bengali poetry"> Bengali poetry</label><br>
    <label><input type="checkbox" name="contemporary_novel" value="Contemporary novel"> Contemporary novel</label><br>
    <label><input type="checkbox" name="contemporary_stories" value="Contemporary stories"> Contemporary stories</label><br>
    <label><input type="checkbox" name="romantic_poetry" value="Romantic poetry"> Romantic poetry</label><br>
    <label><input type="checkbox" name="classical_novel" value="Classical novel"> Classical novel</label><br>
    <label><input type="checkbox" name="translation_self_development" value="Translation: Self-development and meditation"> Translation: Self-development and meditation</label><br>
    <label><input type="checkbox" name="childrens_stories" value="Children's stories"> Children's stories</label><br>
    <label><input type="checkbox" name="mystery_detective_horror" value="Mystery, Detective, Horror, Myth, Thriller, and Adventure: Translation and English"> Mystery, Detective, Horror, Myth, Thriller, and Adventure: Translation and English</label><br>
    <label><input type="checkbox" name="traditional_story" value="Traditional story"> Traditional story</label><br>
    <label><input type="checkbox" name="drama" value="drama"> Drama</label><br>
    <label><input type="checkbox" name="islamic_books" value="Islamic Books: Self-Development"> Islamic Books: Self-Development</label><br>
    <label><input type="checkbox" name="translation_novel" value="Translation novel"> Translation novel</label><br>
    <label><input type="checkbox" name="romantic_novel" value="Romantic novel"> Romantic novel</label><br>
    <label><input type="checkbox" name="rhyme" value="rhyme"> Rhyme</label><br>
    <label><input type="checkbox" name="thriller" value="Thriller"> Thriller</label><br>
            </div>
          </div>
          <div class="sline"></div>
          <div class="category">
            <h3>Author</h3>
            <div class="scat">
              <div class="bar">
                <input type="text" class="barc">
                <div class="sd" style="height: 31px;><a href="#" class="catcon"
                  ><i class="fa-solid fa-magnifying-glass"></i
                ></a></div>
              </div>
            </div>
            <div class="check-box">
              <label><input type="checkbox" name="tagore" value="Rabindranath Tagore"> Rabindranath Tagore</label><br>
              <label><input type="checkbox" name="chatterjee" value="Saratchandra Chatterjee"> Saratchandra Chatterjee</label><br>
              <label><input type="checkbox" name="gangopadhyay" value="Sunil Gangopadhyay (Blue Red)"> Sunil Gangopadhyay (Blue Red)</label><br>
              <label><input type="checkbox" name="roy" value="Sukumar Roy"> Sukumar Roy</label><br>
              <label><input type="checkbox" name="shakespeare" value="William Shakespeare"> William Shakespeare</label><br>
              <label><input type="checkbox" name="verne" value="Jules Verne"> Jules Verne</label><br>
              <label><input type="checkbox" name="rahman" value="Ashiqur Rahman Tutul"> Ashiqur Rahman Tutul</label><br>
              <label><input type="checkbox" name="christie" value="Agatha Christie"> Agatha Christie</label><br>
              <label><input type="checkbox" name="das" value="Jibanananda Das"> Jibanananda Das</label><br>
              <label><input type="checkbox" name="karzawi" value="Dr. Yusuf Al Karzawi"> Dr. Yusuf Al Karzawi</label><br>
              <label><input type="checkbox" name="kabul" value="Nasir Ahmed Kabul"> Nasir Ahmed Kabul</label><br>
              <label><input type="checkbox" name="guna" value="Nirmalendu Guna"> Nirmalendu Guna</label><br>
              <label><input type="checkbox" name="banerjee" value="Manik Banerjee"> Manik Banerjee</label><br>
              <label><input type="checkbox" name="wells" value="HG Wells"> HG Wells</label><br>
              <label><input type="checkbox" name="obaid" value="Ibrahim Obaid"> Ibrahim Obaid</label><br>
              <label><input type="checkbox" name="vibhuti" value="Vibhutibhushan Banerjee"> Vibhutibhushan Banerjee</label><br>
              <label><input type="checkbox" name="yunus" value="Sharif Muhammad Yunus"> Sharif Muhammad Yunus</label><br>
              <label><input type="checkbox" name="ferdous" value="Al Jinnat Ferdous"> Al Jinnat Ferdous</label><br>
              <label><input type="checkbox" name="mondal" value="Bipasha Mondal"> Bipasha Mondal</label><br>
              <label><input type="checkbox" name="shibli" value="Latiful Islam Shibli"> Latiful Islam Shibli</label><br>
              <label><input type="checkbox" name="mahmud" value="Dr. Anu Mahmud"> Dr. Anu Mahmud</label><br>
              <label><input type="checkbox" name="sallabi" value="Dr. Ali Muhammad Sallabi"> Dr. Ali Muhammad Sallabi</label><br>
              <label><input type="checkbox" name="fleming" value="Ian Fleming"> Ian Fleming</label><br>
              <label><input type="checkbox" name="bankim" value="Bankim Chandra Chatterjee"> Bankim Chandra Chatterjee</label><br>
              <label><input type="checkbox" name="tracy" value="Brian Tracy"> Brian Tracy</label><br>
              <label><input type="checkbox" name="islam" value="Kazi Zahirul Islam"> Kazi Zahirul Islam</label><br>
            </div>
          </div>
          <div class="sline"></div>

          <div class="category">
            <h3>Publishers</h3>
            <div class="scat">
              <div class="bar">
                <input type="text" class="barc">
                <div class="sd" style="height: 31px;><a href="#" class="catcon"
                  ><i class="fa-solid fa-magnifying-glass"></i
                ></a></div>
              </div>
            </div>
            <div class="check-box">
              <label><input type="checkbox" name="bivas" value="Bivas"> Bivas</label><br>
              <label><input type="checkbox" name="handful" value="a handful"> A handful</label><br>
              <label><input type="checkbox" name="sahityadesh" value="Sahityadesh"> Sahityadesh</label><br>
              <label><input type="checkbox" name="meghna_publications" value="Meghna Publications"> Meghna Publications</label><br>
              <label><input type="checkbox" name="shadow" value="Shadow"> Shadow</label><br>
              <label><input type="checkbox" name="vidyaprakash" value="Vidyaprakash"> Vidyaprakash</label><br>
              <label><input type="checkbox" name="dear_bengali" value="Dear Bengali publication"> Dear Bengali publication</label><br>
              <label><input type="checkbox" name="great_age" value="Great age"> Great age</label><br>
              <label><input type="checkbox" name="guardian_publications" value="Guardian Publications"> Guardian Publications</label><br>
              <label><input type="checkbox" name="adorn_publications" value="Adorn Publications"> Adorn Publications</label><br>
              <label><input type="checkbox" name="manifestation_talent" value="Manifestation of talent"> Manifestation of talent</label><br>
              <label><input type="checkbox" name="ideal" value="ideal"> Ideal</label><br>
              <label><input type="checkbox" name="table_of_contents" value="table of contents"> Table of contents</label><br>
              <label><input type="checkbox" name="watermarks" value="Publication of watermarks"> Publication of watermarks</label><br>
              <label><input type="checkbox" name="chaman_prakash" value="Chaman Prakash"> Chaman Prakash</label><br>
              <label><input type="checkbox" name="kali_publications" value="Kali Publications"> Kali Publications</label><br>
              <label><input type="checkbox" name="smell_of_earth" value="the smell of earth"> The smell of earth</label><br>
              <label><input type="checkbox" name="darus_salam" value="Darus Salam Bangladesh"> Darus Salam Bangladesh</label><br>
              <label><input type="checkbox" name="nandita_prakash" value="Nandita Prakash"> Nandita Prakash</label><br>
              <label><input type="checkbox" name="priyamukh" value="Priyamukh"> Priyamukh</label><br>
              <label><input type="checkbox" name="maktabatul_furqan" value="Maktabatul Furqan"> Maktabatul Furqan</label><br>
              <label><input type="checkbox" name="other" value="Other"> Other</label><br>
              <label><input type="checkbox" name="shireen_publications" value="Shireen Publications"> Shireen Publications</label><br>
              <label><input type="checkbox" name="karubak" value="Karubak"> Karubak</label><br>
              <label><input type="checkbox" name="great_publications" value="great"> Great</label><br>
              <label><input type="checkbox" name="show_off" value="show off"> Show off</label><br>
              <label><input type="checkbox" name="self_published" value="Self-published"> Self-published</label><br>
              <label><input type="checkbox" name="forerunner_company" value="Forerunner & Company"> Forerunner & Company</label><br>
              <label><input type="checkbox" name="courage_publications" value="Courage Publications"> Courage Publications</label><br>
              <label><input type="checkbox" name="generation_publications" value="Generation Publications"> Generation Publications</label><br>
              <label><input type="checkbox" name="behula_bangla" value="Behula Bangla"> Behula Bangla</label><br>
              <label><input type="checkbox" name="textbooks_publications" value="Publication of textbooks"> Publication of textbooks</label><br>
              <label><input type="checkbox" name="baby" value="baby"> Baby</label><br>
              <label><input type="checkbox" name="muslim_village" value="Muslim Village"> Muslim Village</label><br>
              <label><input type="checkbox" name="beard" value="beard"> Beard</label><br>
              <label><input type="checkbox" name="manifestation" value="Manifestation"> Manifestation</label><br>


            </div>
          </div>
          <div class="sline"></div>
          <div class="category">
            <h3>By Language</h3>
            <div class="scat">
              <div class="bar">
                <input type="text" class="barc">
                <div class="sd" style="height: 31px;><a href="#" class="catcon"
                  ><i class="fa-solid fa-magnifying-glass"></i
                ></a></div>
              </div>
            </div>
            <div class="check-box">
              <label><input type="checkbox" name="bangla" value="Bangla"> Bangla</label><br>
    <label><input type="checkbox" name="english" value="english"> English</label><br>
    <label><input type="checkbox" name="bengali_arabic" value="Bengali and Arabic"> Bengali and Arabic</label><br>
    <label><input type="checkbox" name="bengali_english" value="Bengali and English"> Bengali and English</label><br>
    <label><input type="checkbox" name="bengali_english_arabic" value="Bengali, English, Arabic"> Bengali, English, Arabic</label><br>
    <label><input type="checkbox" name="other_languages" value="other languages"> Other languages</label><br>
    <label><input type="checkbox" name="bengali_arabic_urdu" value="Bengali, Arabic, Urdu"> Bengali, Arabic, Urdu</label><br>
            </div>
          </div>

        </div>

      </div>
<div class="products">
  <?php
  // Connect to the database
  $conn = new mysqli("localhost", "root", "", "bookhub");

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Get distinct categories from the database
  $sql_categories = "SELECT DISTINCT category FROM book";
  $categories_result = $conn->query($sql_categories);

  if ($categories_result->num_rows > 0): 
    while ($category_row = $categories_result->fetch_assoc()):
      $category = $category_row['category'];
  ?>
      <div class="bookcategory">
        <div class="catname">
          <h2><?php echo $category; ?></h2> <!-- Dynamic category name -->
          <button class="ubtn bookbtn" id="viewall">View All</button>
        </div>
        <div class="bookline"></div>
        <button class="scroll-arrow left-arrow">&#9664;</button>
        <div class="book-shelf">
          <?php
          // Get books from the current category
          $sql_books = "SELECT * FROM book WHERE category = '$category'";
          $books_result = $conn->query($sql_books);

          if ($books_result->num_rows > 0): 
            while ($row = $books_result->fetch_assoc()): ?>
              <div class="book">
                <div class="book-img">
                  <a href="book_desc.php?isbn=<?php echo $row['isbn']; ?>">
                    <img src="<?php echo $row['img1']; ?>" alt="">
                  </a>
                </div>

                <!-- View Details Button -->
                <button class="btn view-details" id="viewdet">
                  <a href="book_desc.php?isbn=<?php echo $row['isbn']; ?>">View Details</a>
                </button>

                <div class="book-title">
                  <h2><?php echo $row['title']; ?></h2>
                  <h3><?php echo $row['author']; ?></h3>
                </div>
                <p>Tk <?php echo $row['price']; ?></p>

                <!-- Add To Cart Form -->
                <form action="add_to_cart.php" method="post">
                  <input type="hidden" name="isbn" value="<?php echo $row['isbn']; ?>">
                  <button class="btn add-to-cart" type="submit">Add To Cart</button>
                </form>
              </div>
          <?php 
            endwhile;
          endif;
          ?>
        </div>
        <button class="scroll-arrow right-arrow">&#9654;</button>
      </div>
  <?php 
    endwhile;
  endif;

  $conn->close();
  ?>
</div>


    </div>
    
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
