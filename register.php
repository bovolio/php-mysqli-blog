<?php
    require 'config/config.php';
    require 'config/db.php';


    // Check for submit
    if(isset($_POST['submit'])){
    // Form Variables
    $username= mysqli_real_escape_string($conn, $_POST['username']);
    $password= mysqli_real_escape_string($conn, $_POST['password']);
    $email= mysqli_real_escape_string($conn, $_POST['email']);

        //Check to see values are entered in forms & DB TABLE

        if (!isset($_POST['username'] , $_POST['password'], $_POST['email'])) {
            die ('Please complete the registration form!<br><a href="register.php">Back</a>');
        }

        if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
            die ('Please complete the registration form!<br><a href="register.php">Back</a>');
        }
        if ($stmt = $conn->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
            // Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
            $stmt->bind_param('s', $_POST['username']);
            $stmt->execute(); 
            $stmt->store_result(); 
            // Store the result so we can check if the account exists in the database.
            if ($stmt->num_rows > 0) {
                // Username already exists
                echo "<div class='alert alert-dismissible alert-danger' name='alert-danger'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <strong>Username Exists!</strong> Please Choose another one.
              </div>";
            } else {
                // Username doesnt exists, insert new account
                if ($stmt = $conn->prepare('INSERT INTO accounts (username, password, email) VALUES (?, ?, ?)')) {
                    // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $stmt->bind_param('sss', $_POST['username'], $password, $_POST['email']);
                    $stmt->execute();
                    echo "<div class='alert alert-dismissible alert-success' name='alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>Well done!</strong> Account Created Successfully!
                  </div>";
                } else {
                    echo 'Could not prepare statement!';
                }
            }
            $stmt->close();
        } else {
            echo 'Could not prepare statement!';
        }
        $conn->close();
    }
?>

<?php include 'inc/header.php'; ?>
<?php include 'inc/navbar.php'; ?>
<div class='container'>
    <br>
    <h1>Register</h1>
    <form method='POST' action='<?php $_SERVER['PHP_SELF'];?>'>
        <div class='form-group'>
            <label>Username</label>
            <input type='text' name='username' place-holder='Username' class='form-control' required>
        </div>
        <div class='form-group'>
            <label>Password</label>
            <input type='passsword' name='password' place-holder='Password' class='form-control' required>
        </div>
        <div class='form-group'>
            <label>E-mail</label>
            <input type='email' name='email' place-holder='E-mail' class='form-control' required>
        </div>
        <input type='submit' value='submit' name='submit' class='btn btn-primary'>
    </form>
</div>
<?php include 'inc/footer.php'; ?>