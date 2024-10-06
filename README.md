# BookHub
Excited to share my latest project, BookHub, a dynamic web application designed for a bookshop! Built using HTML, CSS, JavaScript, PHP, and MySQL, the website allows users to browse books by category, manage personal profiles, add/remove items to their cart and wishlist, and track their orders. Key features like profile management, order tracking, and wishlist functions are secured and accessible only to logged-in users, ensuring a seamless and protected experience. Currently working on optimizing the search functionality and sorting options to improve the user experience. This project has been a great opportunity to develop my full-stack development skills!
<br>
Given below is the MYSQL commands:
To create a user: 
CREATE TABLE user (	
    name VARCHAR(100),
    date_of_birth DATE,
    gender CHAR(1),
    phone_number VARCHAR(20),
    address TEXT,
    email VARCHAR(255) PRIMARY KEY,  
    password VARCHAR(255)
);
<br>
To add a book or fetch data from a book:
CREATE TABLE book (
    title VARCHAR(255),
    author VARCHAR(255),
    price DECIMAL(10, 2),
    publisher VARCHAR(255),
    language VARCHAR(50),
    img1 VARCHAR(255),  
    img2 VARCHAR(255),  
    img3 VARCHAR(255),  
    isbn VARCHAR(13) PRIMARY KEY,
    publishing_date DATE,
    total_page INT,
    weight DECIMAL(5, 2),
    category VARCHAR(100),  
    quantity INT,
    description TEXT
);
<br>
To track ordered book
CREATE TABLE ordered_book (
    email VARCHAR(255),
    isbn VARCHAR(13),
    quantity INT,
    total_amount INT,
    confirm BOOLEAN,
    PRIMARY KEY (email, isbn),
    FOREIGN KEY (email) REFERENCES user(email) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (isbn) REFERENCES book(isbn) ON DELETE RESTRICT ON UPDATE CASCADE
);
<br>
To add a book to the wishlist
CREATE TABLE wishlist(
    email VARCHAR(255),
    isbn VARCHAR(13),
    PRIMARY KEY (email, isbn),
    FOREIGN KEY (email) REFERENCES user(email) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (isbn) REFERENCES book(isbn) ON DELETE RESTRICT ON UPDATE CASCADE
);
