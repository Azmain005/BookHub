// Function to update the subtotal and total
function updateSubtotalAndTotal() {
  let subtotal = 0;
  const shippingCost = 100; // Fixed shipping cost

  document.querySelectorAll('.prod').forEach((prod) => {
      const checkbox = prod.querySelector('input[type="checkbox"]');
      if (checkbox.checked) {
          const quantity = parseInt(prod.querySelector('.pquantity-display').textContent);
          const basePrice = parseInt(prod.querySelector('.price').dataset.basePrice);
          const totalPrice = quantity * basePrice;
          subtotal += totalPrice;
      }
  });

  // Update the subtotal and total
  document.querySelector('.st p').textContent = subtotal + 'Tk';
  document.querySelector('.st:last-child p').textContent = (subtotal + shippingCost) + 'Tk';
}

// Function to handle quantity change
function handleQuantityChange(button, isIncrement) {
  const prodDiv = button.closest('.prod');
  const quantityDisplay = prodDiv.querySelector('.pquantity-display');
  let quantity = parseInt(quantityDisplay.textContent);

  if (isIncrement) {
      quantity++;
  } else {
      if (quantity > 1) {
          quantity--;
      }
  }

  quantityDisplay.textContent = quantity;

  // Update the price for the product
  const basePrice = parseInt(prodDiv.querySelector('.price').dataset.basePrice);
  const newPrice = quantity * basePrice;
  prodDiv.querySelector('.price').textContent = `Tk ${newPrice}`;

  // Update the subtotal and total
  updateSubtotalAndTotal();
}

// Function to handle removing a product
function handleRemoveProduct(button) {
  const prodDiv = button.closest('.prod');

  // Add fade-out class for animation
  prodDiv.classList.add('fade-out');

  // Remove the product after the fade-out transition
  setTimeout(() => {
      prodDiv.remove();

      // Check if any products are left
      if (document.querySelectorAll('.prod').length === 0) {
          window.location.href = 'empty_cart.php';
      } else {
          updateSubtotalAndTotal();
      }
  }, 500); // Match this timeout with the CSS transition time
}

// Event listener for checkbox changes
function handleCheckboxChange() {
  updateSubtotalAndTotal();
}

// Event listeners for plus and minus buttons
document.querySelectorAll('.pplus').forEach(button => {
  button.addEventListener('click', () => handleQuantityChange(button, true));
});

document.querySelectorAll('.pminus').forEach(button => {
  button.addEventListener('click', () => handleQuantityChange(button, false));
});

// Event listeners for remove buttons
document.querySelectorAll('.delandwish button').forEach(button => {
  button.addEventListener('click', () => handleRemoveProduct(button));
});

// Event listeners for checkbox changes
document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
  checkbox.addEventListener('change', handleCheckboxChange);
});

// Initial call to set subtotal and total
updateSubtotalAndTotal();
