<?php require '../config/config.php';
      require '../config/db.php';?>
<?php include '../inc/header.php';?>
<?php include '../inc/navbar.php';?>
<?php echo $alert;?>
<div class='container'>
    <br>
    <h1>Login</h1>
    <form method='POST' action='<?php $_SERVER['PHP_SELF'];?>'>
        <div class='form-group'>
            <label>Username</label>
            <input type='text' name='username' class='form-control' value="<?php echo $username; ?>" required>
            <span class="help-block"style='color:red;'><?php echo $username_err; ?></span>
        </div>
        <div class='form-group'>
            <label>Password</label>
            <input type='password' name='password' class='form-control' required>
            <span class="help-block"style='color:red;'><?php echo $password_err; ?></span>
        </div>
        <input type='submit' value='submit' name='submit' class='btn btn-primary'>
    </form>
    <br>
    <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
</div>
<?php include '../inc/footer.php';?>