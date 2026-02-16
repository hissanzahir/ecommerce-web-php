<?php
include ('config/dbcon.php');
if (isset($_POST['UPLOAD'])) {
    $NAME = $_POST['name'];
    $DESCRIPTION = $_POST['description'];
    $QUANTITY = $_POST['quantity'];
    $PRICE = $_POST['price'];

    $img_name = time() . "_" . $_FILES['image']['name']; 
    $img_loc = $_FILES['image']['tmp_name'];
    $img_des = "pimages/" . $img_name;

    if (move_uploaded_file($img_loc, $img_des)) {
        $query = "INSERT INTO `product1`(`name`, `description`, `quantity`, `price`, `image`) 
                  VALUES ('$NAME','$DESCRIPTION','$QUANTITY','$PRICE','$img_des')";
        mysqli_query($con, $query);
    }
    header('Location: product.php');
    exit;
}
?>
<?php 
include ('includes/header.php');
include ('includes/topbar.php');
include ('includes/sidebar.php');

?>

<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">ADD PRODUCTS</h3>
                </div>

                <form action="productinsert.php" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">NAME</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="ENTER NAME">
                        </div>
                        <div class="form-group">
                            <label for="description">DESCRIPTION</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="ENTER DESCRIPTION">
                        </div>
                        <div class="form-group">
                            <label for="price">PRICE</label>
                            <input type="text" class="form-control" id="price" name="price" placeholder="ENTER PRICE">
                        </div>
                        <div class="form-group">
                            <label for="name">QUANTITY</label>
                            <input type="text" class="form-control" id="quantity" name="quantity" placeholder="ENTER QUANTITY">
                        </div>
                        <div class="form-group">
                            <label for="image">IMAGE </label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="image">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" name="UPLOAD">UPLOAD</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<?php include ('includes/footer.php'); ?>