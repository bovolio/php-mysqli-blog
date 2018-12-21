<?php require '../config/config.php';
      require '../config/db.php';
      
      session_start();

      if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
          header("location: welcome.php");
          exit;
      }
      //defining variables
      $username = mysqli_real_escape_string($conn, $_POST['username']);
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $password = mysqli_real_escape_string($conn, $_POST['password']);
      $u_error = $p_error = '';

      if(isset($_POST['submit'])){
        
        if(empty(trim($_POST["username"]))){
            $u_error = "Please enter username.";
            $username = '';
        }
        if(empty(trim($_POST["password"]))){
            $p_error = "Please enter your password.";
            $password = '';
        }
      
        if(empty($u_error) && empty($p_error)){
            // Prepare a select statement
            if ($stmt = $conn->prepare("SELECT id, username, password FROM accounts WHERE username = ?")){
                $stmt->bind_param('s', $username);
                $stmt->execute(); 
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            session_start();
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            header("location: welcome.php");
                        } else{
                            $p_error = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            $stmt->close();
        }
      $conn->close();
    }
      ?>
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
            <span class="help-block"style='color:red;'><?php echo $u_error; ?></span>
        </div>
        <div class='form-group'>
            <label>Password</label>
            <input type='password' name='password' class='form-control' required>
            <span class="help-block"style='color:red;'><?php echo $p_error; ?></span>
        </div>
        <input type='submit' value='submit' name='submit' class='btn btn-primary'>
    </form>
    <br>
    <p>Don't have an account? <a href="/register.php">Sign up now</a>.</p>
</div>
<?php include '../inc/footer.php';?>