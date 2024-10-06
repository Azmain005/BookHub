// document.addEventListener('DOMContentLoaded', () => {
//     // Set default image
//     const picDiv = document.getElementById('pic');
//     picDiv.style.backgroundImage = 'url("/static/imgs/desc1.jpg")';
  
//     // Add click event listeners to minibook divs
//     const minibooks = document.querySelectorAll('.minibook');
//     minibooks.forEach(minibook => {
//       minibook.addEventListener('click', () => {
//         const imageUrl = minibook.getAttribute('data-image');
//         picDiv.style.backgroundImage = `url('${imageUrl}')`;
//       });
//     });
//   });
  
//   //quantity
//   document.addEventListener('DOMContentLoaded', () => {
//     const quantityDisplay = document.getElementById('quantity');
//     const minusButton = document.getElementById('minus');
//     const plusButton = document.getElementById('plus');
  
//     minusButton.addEventListener('click', () => {
//       let currentQuantity = parseInt(quantityDisplay.textContent);
//       if (currentQuantity > 1) {
//         quantityDisplay.textContent = currentQuantity - 1;
//       }
//     });
  
//     plusButton.addEventListener('click', () => {
//       let currentQuantity = parseInt(quantityDisplay.textContent);
//       quantityDisplay.textContent = currentQuantity + 1;
//     });
//   });
  

//   document.addEventListener("DOMContentLoaded", () => {
//     const wishlistButton = document.querySelector(".wishlist");
//     let isHearted = false;
  
//     wishlistButton.addEventListener("click", () => {
//       if (isHearted) {
//         wishlistButton.innerHTML = '<i class="fa-regular fa-heart"></i>';
//       } else {
//         wishlistButton.innerHTML = '<i class="fa-solid fa-heart"></i>';
//       }
//       isHearted = !isHearted;
//     });
//   });
  

document.addEventListener('DOMContentLoaded', () => {
  // Set default image
  const picDiv = document.getElementById('pic');
  picDiv.style.backgroundImage = 'url("<?php echo htmlspecialchars($book['img1']); ?>")'; 

  // Add click event listeners to minibook divs
  const minibooks = document.querySelectorAll('.minibook');
  minibooks.forEach(minibook => {
    minibook.addEventListener('click', () => {
      const imageUrl = minibook.getAttribute('data-image');
      picDiv.style.backgroundImage = `url('${imageUrl}')`;
    });
  });

  Quantity
  const quantityDisplay = document.getElementById('quantity');
  const minusButton = document.getElementById('minus');
  const plusButton = document.getElementById('plus');

  minusButton.addEventListener('click', () => {
    let currentQuantity = parseInt(quantityDisplay.textContent);
    if (currentQuantity > 1) {
      quantityDisplay.textContent = currentQuantity - 1;
    }
  });

  plusButton.addEventListener('click', () => {
    let currentQuantity = parseInt(quantityDisplay.textContent);
    quantityDisplay.textContent = currentQuantity + 1;
  });

  // Wishlist
  const wishlistButton = document.querySelector(".wishlist");
  let isHearted = false;

  wishlistButton.addEventListener("click", () => {
    if (isHearted) {
      wishlistButton.innerHTML = '<i class="fa-regular fa-heart"></i>';
    } else {
      wishlistButton.innerHTML = '<i class="fa-solid fa-heart"></i>';
    }
    isHearted = !isHearted;
  });
});


