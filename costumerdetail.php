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

// Fetch all data from the customerinfo1 table
$query = "SELECT * FROM customerinfo1";
$result = mysqli_query($con, $query);
?>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Customer Details</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="customerTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Country</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Postal Code</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Order Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . htmlspecialchars($row['fn']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['ln']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['country']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['city']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['state']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['postalcode']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                echo "<td>$" . htmlspecialchars($row['orderamount']) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='11' class='text-center'>No data found</td></tr>";
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