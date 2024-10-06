document.addEventListener("DOMContentLoaded", function () {
    const books = document.querySelectorAll(".prod");
    let subtotal = 0;
    const subtotalEl = document.getElementById("subtotal");
    const totalEl = document.getElementById("total");

    // Update subtotal and total based on the selected books
    function updateTotals() {
        subtotal = 0;
        books.forEach(book => {
            const checkbox = book.querySelector(".book-check");
            const priceEl = book.querySelector(".price");
            const price = parseFloat(priceEl.dataset.basePrice);
            const quantity = parseInt(book.querySelector(".pquantity-display").textContent);

            if (checkbox.checked) {
                subtotal += price * quantity;
            }
        });
        subtotalEl.textContent = subtotal + " Tk";
        totalEl.textContent = (subtotal + 100) + " Tk"; // Add shipping cost
    }

    // Handle quantity changes
    books.forEach(book => {
        const minusBtn = book.querySelector(".pminus");
        const plusBtn = book.querySelector(".pplus");
        const quantityDisplay = book.querySelector(".pquantity-display");
        const maxQuantity = parseInt(plusBtn.dataset.max);
        const isbn = minusBtn.dataset.isbn;

        minusBtn.addEventListener("click", function () {
            let quantity = parseInt(quantityDisplay.textContent);
            if (quantity > 1) {
                quantity--;
                quantityDisplay.textContent = quantity;
                updateCartQuantity(isbn, quantity);
                updateTotals();
            }
        });

        plusBtn.addEventListener("click", function () {
            let quantity = parseInt(quantityDisplay.textContent);
            if (quantity < maxQuantity) {
                quantity++;
                quantityDisplay.textContent = quantity;
                updateCartQuantity(isbn, quantity);
                updateTotals();
            }
        });
    });

    // Handle book deletion
    document.querySelectorAll(".delete-btn").forEach(button => {
        button.addEventListener("click", function () {
            const isbn = button.dataset.isbn;
            deleteBook(isbn, button.closest(".prod"));
        });
    });

    // Update cart quantities via AJAX
    function updateCartQuantity(isbn, quantity) {
        fetch("update_cart.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ isbn, quantity })
        }).then(response => response.json())
            .then(data => {
                if (!data.success) {
                    alert("Failed to update quantity");
                }
            });
    }

    // Delete book from cart via AJAX
    function deleteBook(isbn, bookElement) {
        fetch("delete_from_cart.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ isbn })
        }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    bookElement.remove();
                    updateTotals();
                } else {
                    alert("Failed to delete book");
                }
            });
    }

    // Update totals on page load
    updateTotals();

    // Handle Buy Now button
    document.getElementById("buy-now-btn").addEventListener("click", function () {
        fetch("confirm_order.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({})
        }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Order confirmed!");
                } else {
                    alert("Failed to confirm order");
                }
            });
    });
});