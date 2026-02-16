<?php
include('config/dbcon.php');

// Check if the product ID is provided
if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']); // Sanitize the input

    // Delete the product from the product1 table
    $delete_query = "DELETE FROM product1 WHERE id = $product_id";
    if (mysqli_query($con, $delete_query)) {
        // Redirect to the correct product page with a success message
        header("Location: product.php?message=Product deleted successfully");
        exit();
    } else {
        // Redirect to the correct product page with an error message
        header("Location: product.php?message=Error deleting product");
        exit();
    }
} else {
    // Redirect to the correct product page if no ID is provided
    header("Location: product.php?message=No product ID provided");
    exit();
}
?>
