<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<section class="section">
    <h2>Your Cart</h2>

    <div class="cart-container">

        <div class="cart-items">

            <div class="cart-item">
                <img src="../assets/images/sid1.jpg" alt="Product">

                <div class="cart-info">
                    <h3>T-shirt Superman Is Dead</h3>
                    <p>Official underground punk rock merchandise.</p>
                    <span class="price">Rp305,000</span>
                </div>

                <div class="cart-qty">
                    <button>-</button>
                    <span>1</span>
                    <button>+</button>
                </div>

                <button class="remove-btn">Remove</button>
            </div>

            <div class="cart-item">
                <img src="../assets/images/tos1.jpg" alt="Product">

                <div class="cart-info">
                    <h3>T-shirt The Offspring</h3>
                    <p>Premium cotton merch collection.</p>
                    <span class="price">Rp850,000</span>
                </div>

                <div class="cart-qty">
                    <button>-</button>
                    <span>1</span>
                    <button>+</button>
                </div>

                <button class="remove-btn">Remove</button>
            </div>

        </div>

        <div class="cart-summary">
            <h3>Order Summary</h3>

            <div class="summary-row">
                <span>Subtotal</span>
                <span>Rp1,155,000</span>
            </div>

            <div class="summary-row">
                <span>Shipping</span>
                <span>Rp25,000</span>
            </div>

            <div class="summary-row total">
                <span>Total</span>
                <span>Rp1,180,000</span>
            </div>

            <a href="checkout.php" class="btn checkout-btn">Proceed to Checkout</a>
        </div>

    </div>
</section>

<?php include '../includes/footer.php'; ?>