<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<?php require '../config/config.php'; 
 include '../inc/header.php';
 include '../inc/navbar.php'; ?>
 
    <div class="jumbotron">
        <h1>Welcome <b><?php echo htmlspecialchars($_SESSION["username"]); ?>!</b></h1>
<br>
    <p>
        <a href="/reset-password.php" class="btn btn-warning">Reset Your Password</a>
    </p>
    </div>
<?php include '../inc/footer.php'; ?>