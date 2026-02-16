<?php
include('config/dbcon.php');

// Fetch product data for update form
if (isset($_GET['id'])) {
    $ID = $_GET['id'];
    $record = mysqli_query($con, "SELECT `id`, `name`, `description`, `quantity`, `price`, `image` FROM `product1` WHERE id=$ID");

    if ($record && mysqli_num_rows($record) > 0) {
        $data = mysqli_fetch_array($record);
    } else {
        echo "Product not found!";
        exit;
    }
} else {
    echo "No ID provided!";
    exit;
}

// Handle form submission
if (isset($_POST['UPDATE'])) {
    $ID = $_POST['id'];
    $NAME = $_POST['name'];
    $DESCRIPTION = $_POST['description'];
    $QUANTITY = $_POST['quantity'];
    $PRICE = $_POST['price'];

    // Handle image upload if a new image is provided
    if (!empty($_FILES['image']['name'])) {
        $img_name = time() . "_" . $_FILES['image']['name'];
        $img_loc = $_FILES['image']['tmp_name'];
        $img_des = "pimages/" . $img_name;

        if (move_uploaded_file($img_loc, $img_des)) {
            $query = "UPDATE `product1` SET 
                        `name`='$NAME',
                        `description`='$DESCRIPTION',
                        `quantity`='$QUANTITY',
                        `price`='$PRICE',
                        `image`='$img_des'
                      WHERE `id`='$ID'";
        }
    } else {
        // If no new image uploaded, keep existing image
        $query = "UPDATE `product1` SET 
                    `name`='$NAME',
                    `description`='$DESCRIPTION',
                    `quantity`='$QUANTITY',
                    `price`='$PRICE'
                  WHERE `id`='$ID'";
    }

    mysqli_query($con, $query);
    header('Location: product.php');
    exit;
}
?>

<?php 
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">UPDATE PRODUCT</h3>
                </div>

                <form action="productupdate.php?id=<?php echo $ID; ?>" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="productName">Product Name</label>
                            <input type="text" class="form-control" id="productName" name="name" 
                                   value="<?php echo $data['name']; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="productDescription">Product Description</label>
                            <textarea class="form-control" id="productDescription" name="description" required><?php echo $data['description']; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="productQuantity">Product Quantity</label>
                            <input type="number" class="form-control" id="productQuantity" name="quantity" 
                                   value="<?php echo $data['quantity']; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="productPrice">Product Price</label>
                            <input type="text" class="form-control" id="productPrice" name="price" 
                                   value="<?php echo $data['price']; ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Current Image:</label><br>
                            <img src="<?php echo $data['image']; ?>" width="150px" height="150px"><br><br>
                            <label for="productImage">Change Product Image</label>
                            <input type="file" class="form-control" id="productImage" name="image">
                        </div>

                        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

                        <br>
                        <button type="submit" class="btn btn-primary" name="UPDATE">UPDATE</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<?php include('includes/footer.php'); ?>
