<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<?php 
include ('includes/header.php');
include ('includes/topbar.php');
include ('includes/sidebar.php');
include ('config/dbcon.php');
?>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="productinsert.php" class="btn btn-primary">ADD PRODUCT</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NAME</th>
                                        <th>DESCRIPTION</th>
                                        <th>PRICE</th>
                                        <th>QUANTITY</th>
                                        <th>IMAGE</th>
                                        <th>UPDATE</th>
                                        <th>DELETE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $query = "SELECT * FROM `product1`";
                                    $result = mysqli_query($con, $query);
                                    if (!$result) {
                                        die("Query failed");
                                    } else {
                                        $count = 1;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $count; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['description']; ?></td>
                                                <td><?php echo $row['price']; ?></td>
                                                <td><?php echo $row['quantity']; ?></td>
                                                <td><img src='<?php echo $row['image']; ?>' width='100px' height='85px'></td>
                                                <td><a href='productupdate.php?id=<?php echo $row['id']; ?>' class='btn btn-success'>UPDATE</a></td>
                                                <td><a href='productdelete.php?id=<?php echo $row['id']; ?>' class='btn btn-danger'>DELETE</a></td>
                                            </tr>
                                            <?php
                                            $count++;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<?php include ('includes/footer.php');?>
