<?php
include('config/dbcon.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Retrieve product names
    $products = isset($_POST['products']) ? $_POST['products'] : [];
    $quantities = isset($_POST['quantities']) ? $_POST['quantities'] : [];
    $individual_totals = isset($_POST['individual_totals']) ? $_POST['individual_totals'] : [];
    
    // Retrieve overall total price
    $total_price = isset($_POST['total_price']) ? $_POST['total_price'] : 0;
}

if (isset($_POST['placeorder'])) {
    $fn =  $_POST['fn'];
    $ln =  $_POST['ln'];
    $country =  $_POST['country'];
    $address =  $_POST['address'];
    $city =  $_POST['city'];
    $state =  $_POST['state'];
    $postalcode =  $_POST['postalcode'];
    $phone =  $_POST['phone'];
    $email =  $_POST['email'];
    $orderamount = isset($_SESSION['cart_total']) ? $_SESSION['cart_total'] : 0;

    // Step 2: Insert into `customerinfo1` table
    $customer_query = "INSERT INTO customerinfo1 (fn, ln, country, address, city, state, postalcode, phone, email, orderamount) 
                       VALUES ('$fn', '$ln', '$country', '$address', '$city', '$state', '$postalcode', '$phone', '$email', '$orderamount')";                  
    
    if (mysqli_query($con, $customer_query)) {
        $id = mysqli_insert_id($con);

        // Step 3: Insert product details into `orders1` table
        if (!empty($products) && !empty($quantities) && !empty($individual_totals)) {
            for ($i = 0; $i < count($products); $i++) {
                $product_name = mysqli_real_escape_string($con, $products[$i]);
                $quantity = mysqli_real_escape_string($con, $quantities[$i]);
                $total = mysqli_real_escape_string($con, $individual_totals[$i]);

                // Debugging: Check the value of $total
                var_dump($total);

                // Insert each product into `orders1` table
                $order_query = "INSERT INTO orders1 (customer_id, p_name, p_quantity, p_total) 
                                VALUES ('$id', '$product_name', '$quantity', '$total')";
                if (!mysqli_query($con, $order_query)) {
                    echo "Error inserting product: " . mysqli_error($con);
                }
            }
            echo "Products inserted successfully!";
        } else {
            echo "No product data found.";
        }

        echo "Customer information inserted successfully!";
    } else {
        echo "Error inserting customer information: " . mysqli_error($con);
    }
}
?>
<?php include 'header.php'; ?>
    <!-- Header Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Check Out</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <a href="./shop.html">Shop</a>
                            <span>Check Out</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form method="post" action="checkout.php">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <h6 class="coupon__code"><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click
                            here</a> to enter your code</h6>
                            <h6 class="checkout__title">Billing Details</h6>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Fist Name<span>*</span></p>
                                        <input type="text" name="fn">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text" name="ln">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                <input type="text" name="country">
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" placeholder="Street Address"  name="address" class="checkout__input__add">
                            </div>
                            <div class="checkout__input">
                                <p>City<span>*</span></p>
                                <input type="text" name="city">
                            </div>
                            <div class="checkout__input">
                                <p>State<span>*</span></p>
                                <input type="text" name="state">
                            </div>
                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="text" name="postalcode">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" name="phone">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" name="email">
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-lg-4 col-md-6">
    <div class="checkout__order">
        <h4 class="order__title">Your order</h4>
        <div class="checkout__order__products" style="display: flex; justify-content: space-between; font-weight: bold;">
            <span>Product</span>
            <span>Quantity</span>
            <span>Total</span>
        </div>
        <ul class="checkout__total__products" style="list-style: none; padding: 0;">
            <?php
            // Ensure the POST data exists
            if (isset($_POST['products'], $_POST['quantities'], $_POST['individual_totals'])) {
                $products = $_POST['products'];
                $quantities = $_POST['quantities'];
                $individual_totals = $_POST['individual_totals'];

                // Loop through the products and display them
                foreach ($products as $index => $product) {
                    $quantity = $quantities[$index];
                    $total = $individual_totals[$index];
                    echo "<li style='display: flex; justify-content: space-between; margin-bottom: 10px;'>
                            <span>" . htmlspecialchars($product) . "</span>
                            <span>" . htmlspecialchars($quantity) . "</span>
                            <span>$ " . htmlspecialchars($total) . "</span>
                          </li>";

                         // Add hidden inputs for each product
                    echo "<input type='hidden' name='products[]' value='" . htmlspecialchars($product) . "'>";
                    echo "<input type='hidden' name='quantities[]' value='" . htmlspecialchars($quantity) . "'>";
                    echo "<input type='hidden' name='individual_totals[]' value='" . htmlspecialchars($total) . "'>";
             

                }
            } else {
                echo "<li>No items in your order.</li>";
            }
            ?>
        </ul>
        <ul class="checkout__total__all" style="list-style: none; padding: 0; margin-top: 20px;">
            <li style="display: flex; justify-content: space-between; font-weight: bold;">
                <span>Total</span>
                <span>$<?php echo isset($_POST['total_price']) ? htmlspecialchars($_POST['total_price']) : '0'; ?></span>
            </li>
        </ul>
        <button type="submit" name="placeorder"   class="site-btn">PLACE ORDER </button>
    </div>
</div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="#"><img src="img/footer-logo.png" alt=""></a>
                        </div>
                        <p>The customer is at the heart of our unique business model, which includes design.</p>
                        <a href="#"><img src="img/payment.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Shopping</h6>
                        <ul>
                            <li><a href="#">Clothing Store</a></li>
                            <li><a href="#">Trending Shoes</a></li>
                            <li><a href="#">Accessories</a></li>
                            <li><a href="#">Sale</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Shopping</h6>
                        <ul>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Payment Methods</a></li>
                            <li><a href="#">Delivary</a></li>
                            <li><a href="#">Return & Exchanges</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <h6>NewLetter</h6>
                        <div class="footer__newslatter">
                            <p>Be the first to know about new arrivals, look books, sales & promos!</p>
                            <form action="#">
                                <input type="text" placeholder="Your email">
                                <button type="submit"><span class="icon_mail_alt"></span></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="footer__copyright__text">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        <p>Copyright ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>2020
                            All rights reserved | This template is made with <i class="fa fa-heart-o"
                            aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        </p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery.nicescroll.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>