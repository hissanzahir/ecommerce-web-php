
<?php 
include ('config/dbcon.php');

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo "<script>alert('Signup successful!'); window.location.href='login.php';</script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
<?php
include ('includes/header.php');
include ('includes/topbar.php');
include ('includes/sidebar.php');
include ('includes/footer.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
<div class="content-wrapper">
<div class="container-fluid">
<form method="POST" action="">
<div class="card card-primary" >
    <div class="card-header">
        <h2 class="text-center">Signup</h2>
    </div>
    <div class="card-body" style="padding: 10px;">
        <div class="form-group">
            <label>Username:</label>
            <input type="text" name="username" required class="form-control">
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" required class="form-control">
        </div>
        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password" required class="form-control">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Signup</button>
    </form>
</div>
</div>
</div>
</body>
</html>
