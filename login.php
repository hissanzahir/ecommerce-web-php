<?php
session_start();
include ('config/dbcon.php');

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<script>alert('Invalid username or password');</script>";
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
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
<div class="content-wrapper">
    <div class="container-fluid">
        <form method="POST" action="">
            <div class="card card-primary" >
                <div class="card-header">
                    <h2 class="text-center">Login</h2>
                </div>
                <div class="card-body" style="padding: 10px;">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required />
                        </div>
                        <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>
