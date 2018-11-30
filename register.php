<?php
    require 'config/config.php';
    require 'config/db.php';


    // Check for submit
    if(isset($_POST['submit'])){
    // Form Variables
    $username=htmlentities(trim(mysqli_real_escape_string($conn, $_POST['username'])));
    $email= htmlentities(trim(mysqli_real_escape_string($conn, $_POST['email'])));

        //Check to see values are entered in forms & DB TABLE
        if (!isset($_POST['username'] , $_POST['password'], $_POST['email'])) {
            die ('Please complete the registration form!<br><a href="register.php">Back</a>');
        }
        if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
            die ('Please complete the registration form!<br><a href="register.php">Back</a>');
        }

        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter a password.";     
        } elseif(strlen(trim($_POST["password"])) < 6){
            $password_err = "Password must have atleast 6 characters.";
        } else{
            $password = trim(mysqli_real_escape_string($conn, $_POST['password']));
        }

        if(empty(trim($_POST["confirm_password"]))){
            $confirm_password_err = "Please confirm password.";     
        } else{
            $confirm_password = trim(mysqli_real_escape_string($conn, $_POST["confirm_password"]));
            if(empty($password_err) && ($password != $confirm_password)){
                $confirm_password_err = "Password did not match.";
        }
    } 
        if ($stmt = $conn->prepare('SELECT id, password FROM accounts WHERE email = ?')){
            $stmt->bind_param('s', $email);
            $stmt->execute(); 
            $stmt->store_result(); 
            // Store the result so we can check if the email exists in the database.
            if ($stmt->num_rows > 0) {
                // Email already exists
                $email_err = "E-mail already exists! Please choose another.";
        } else {
        if ($stmt = $conn->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
            $stmt->bind_param('s', $username);
            $stmt->execute(); 
            $stmt->store_result(); 
            // Store the result so we can check if the account exists in the database.
            if ($stmt->num_rows > 0) {
                // Username already exists
                $username_err= "Username already exists! Please choose another.";
            } else {
                //if errors are empty
                if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
                // Username and Email don't exist, insert new account
                if ($stmt = $conn->prepare('INSERT INTO accounts (username, password, email) VALUES (?, ?, ?)')) {
                    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
                    $stmt->bind_param('sss', $username, $passwordHashed, $email);
                    $stmt->execute();
                    $alert = "<div class='alert alert-dismissible alert-success' name='alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>Well done!</strong> Account Created Successfully!
                  </div>";
                } 
                }
            }
            $stmt->close();
        }
        $conn->close();
    }
}
    }

?>

<?php include 'inc/header.php'; ?>
<?php include 'inc/navbar.php'; ?>
<?php echo $alert;?>
<div class='container'>
    <br>
    <h1>Register</h1>
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
        <div class='form-group'>
        <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" required>
                <span class="help-block"style='color:red;'><?php echo $confirm_password_err; ?></span>
            </div>
        <div class='form-group'>
            <label>E-mail</label>
            <input type='email' name='email' class='form-control' value="<?php echo $email; ?>" required>
            <span class="help-block"style='color:red;'><?php echo $email_err; ?></span>
        </div>
        <input type='submit' value='submit' name='submit' class='btn btn-primary'>
    </form>
    <br>
    <p>Already have an account? <a href="login.php">Login here</a>.</p>
</div>
<?php include 'inc/footer.php'; ?>