// my profile

let subMenu = document.getElementById("subMenu");
function toggleMenu(){
    subMenu.classList.toggle("open-menu");
}

// sign in button
document.getElementById('signInButton').addEventListener('click', function() {
    window.location.href = 'login.php';
});


// header slider
const imgs = document.querySelectorAll('.header-slider ul img');
const prev_btn = document.querySelector('.control_prev');
const next_btn = document.querySelector('.control_next');

let n = 0;


function changeSlide(){
    for (let i = 0; i < imgs.length; i++) {
        imgs[i].style.display = 'none';  
    }
    imgs[n].style.display = 'block';
}

changeSlide();

prev_btn.addEventListener('click', (e)=>{
    if(n > 0) {
        n--;
    } else {
        n = imgs.length - 1;
    }
    changeSlide();
})

next_btn.addEventListener('click', (e)=>{
    if(n < imgs.length - 1) {
        n++;
    } else {
        n = 0;
    }
    changeSlide();
})

//book slider

document.addEventListener("DOMContentLoaded", function() {
    const bookShelves = document.querySelectorAll('.book-shelf');
  
    bookShelves.forEach(bookShelf => {
      const leftArrow = bookShelf.previousElementSibling;
      const rightArrow = bookShelf.nextElementSibling;
  
      leftArrow.addEventListener('click', function() {
        bookShelf.scrollBy({
          left: -300, // Adjust the scroll distance
          behavior: 'smooth'
        });
      });
  
      rightArrow.addEventListener('click', function() {
        bookShelf.scrollBy({
          left: 300, // Adjust the scroll distance
          behavior: 'smooth'
        });
      });
    });
  });
  
//view details
document.addEventListener('DOMContentLoaded', function () {
  document.getElementById('viewdet').addEventListener('click', function () {
    window.location.href = 'book_desc.php';
  });

  document.getElementById('viewall').addEventListener('click', function () {
    window.location.href = 'viewall.php';
  });

  document.getElementById('wishl').addEventListener('click', function () {
    window.location.href = 'wishlist.php';
  });
});
