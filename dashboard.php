<?php 

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include ('includes/header.php');
include ('includes/topbar.php');
include ('includes/sidebar.php');
include ('config/dbcon.php');

// Fetch counts from the database
$order_count_query = "SELECT COUNT(*) AS total_orders FROM orders1";
$order_count_result = mysqli_query($con, $order_count_query);
$order_count = mysqli_fetch_assoc($order_count_result)['total_orders'];

$customer_count_query = "SELECT COUNT(*) AS total_customers FROM customerinfo1";
$customer_count_result = mysqli_query($con, $customer_count_query);
$customer_count = mysqli_fetch_assoc($customer_count_result)['total_customers'];

$product_count_query = "SELECT COUNT(*) AS total_products FROM product1";
$product_count_result = mysqli_query($con, $product_count_query);
$product_count = mysqli_fetch_assoc($product_count_result)['total_products'];
?>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <!-- Orders Section -->
            <div class="col-lg-4 col-12">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?php echo $order_count; ?></h3>
                        <p>Orders</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="orders.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- Customers Section -->
            <div class="col-lg-4 col-12">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?php echo $customer_count; ?></h3>
                        <p>Customers</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="customers.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- Total Products Section -->
            <div class="col-lg-4 col-12">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?php echo $product_count; ?></h3>
                        <p>Total Products</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-box