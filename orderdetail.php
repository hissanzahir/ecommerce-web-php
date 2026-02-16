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

// Fetch all data from the orders1 table
$query = "SELECT * FROM orders1";
$result = mysqli_query($con, $query);
?>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title text-center" style="color: blue;">Order Details</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="orderTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer ID</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . htmlspecialchars($row['customer_id']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['p_name']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['p_quantity']) . "</td>";
                                echo "<td>$" . htmlspecialchars($row['p_total']) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center'>No data found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

<?php include ('includes/footer.php'); ?>
