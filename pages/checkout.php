<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<section class="section">
    <h2>Checkout</h2>

    <div class="checkout-container">

        <div class="checkout-form">
            <h3>Customer Information</h3>

            <form>
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" placeholder="Enter your full name">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" placeholder="Enter your email">
                </div>

                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" placeholder="Enter your phone number">
                </div>

                <div class="form-group">
                    <label>Shipping Address</label>
                    <textarea placeholder="Enter shipping address"></textarea>
                </div>

                <div class="form-group">
                    <label>Payment Method</label>
                    <select>
                        <option>Bank Transfer</option>
                        <option>QRIS</option>
                        <option>COD</option>
                    </select>
                </div>

                <button type="submit" class="btn place-order-btn">
                    Place Order
                </button>
            </form>
        </div>

        <div class="checkout-summary">
            <h3>Order Summary</h3>

            <div class="summary-row">
                <span>T-shirt Superman Is Dead</span>
                <span>Rp305,000</span>
            </div>

            <div class="summary-row">
                <span>T-shirt The Offspring</span>
                <span>Rp850,000</span>
            </div>

            <div class="summary-row">
                <span>Shipping</span>
                <span>Rp25,000</span>
            </div>

            <div class="summary-row total">
                <span>Total</span>
                <span>Rp1,180,000</span>
            </div>
        </div>

    </div>
</section>

<?php include '../includes/footer.php'; ?>