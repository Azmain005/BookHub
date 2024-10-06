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