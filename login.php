<?php require_once 'config/config.php';
      require_once 'config/db.php';
      
    session_start();
 
    // Check if the user is already logged in, if yes then redirect him to welcome page
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
    // Check for submit
    if(isset($_POST['submit'])){

        $username= $email = '';

        //Check for empty form submissions
        if(empty(trim($_POST["username"]))){
            $username_err = "Please enter username.";
        } else{
            $username = trim($_POST["username"]);
        }
        
        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter your password.";
        } else{
            $password = trim($_POST["password"]);
        }

    // validates forms
    if(empty($username_err) && empty($password_err)){
        $query = "SELECT id, username, password FROM testdb WHERE username = ?";
        if ($stmt = $conn->prepare($query)){
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();
        $stmt;
            if($stmt == 1){
                $stmt->bind_result($id, $username, $hashed_password);
                $stmt->fetch();
                if(password_verify($password, $hashed_password)){
                    // Password is correct, so start a new session
                    session_start();
                    
                    // Store data in session variables
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $id;
                    $_SESSION["username"] = $username;                            
                    
                    // Redirect user to welcome page
                    header("location: welcome.php");
                } else{
                    // Display an error message if password is not valid
                    $password_err = "The password you entered was not valid.";
                }

            }else{
                // Display an error message if username doesn't exist
                $username_err = "No account found with that username.";
            }
        }
        mysqli_stmt_close($stmt);

    }
    mysqli_close($conn);
    }
      ?>
<?php include_once 'inc/header.php';?>
<?php include_once 'inc/navbar.php';?>
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
<?php include_once 'inc/footer.php';?>