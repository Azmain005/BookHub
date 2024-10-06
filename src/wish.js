document.addEventListener("DOMContentLoaded", function () {
  updateWishlistCount();

  function updateWishlistCount() {
    const wishlistCount = document.querySelectorAll('.wish').length;
    const countText = document.querySelector('.intro h3');
    countText.textContent = `You have ${wishlistCount} product(s) in your wishlist`;
    adjustWishDivHeight();
    checkEmptyWishlist();
  }

  function adjustWishDivHeight() {
    const wishDiv = document.querySelector('.wishdiv');
    const wishlistCount = document.querySelectorAll('.wish').length;
    wishDiv.style.minHeight = `${wishlistCount * 250}px`; // Adjust height dynamically
  }

  function removeWishlistItem(event) {
    const wishItem = event.target.closest('.wish');
    if (wishItem) {
      wishItem.classList.add('removing');
      wishItem.addEventListener('transitionend', function () {
        wishItem.remove();
        updateWishlistCount();
      });
    }
  }

  // function checkEmptyWishlist() {
  //   const wishlistCount = document.querySelectorAll('.wish').length;
  //   const wishDiv = document.querySelector('.wishdiv');
  //   const emptyWishlistDiv = document.querySelector('.empty-wishlist');
  //   if (wishlistCount === 0) {
  //     wishDiv.remove();
  //     emptyWishlistDiv.style.display = 'flex';
  //   } 
  //   else {
  //     emptyWishlistDiv.style.display = 'none';
  //   }
  // }

  const trashButtons = document.querySelectorAll('.trashwish');
  trashButtons.forEach(button => {
    button.addEventListener('click', removeWishlistItem);
  });
});
