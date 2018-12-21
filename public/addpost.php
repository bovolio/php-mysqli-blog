<?php
session_start();
    require '../config/config.php';
    require '../config/db.php';

    // Check for submit
    if(isset($_POST['submit_add'])){
    // Form Variables
    $title= mysqli_real_escape_string($conn, $_POST['title']);
    $body= mysqli_real_escape_string($conn, $_POST['body']);
    $author= mysqli_real_escape_string($conn, $_POST['author']);
    
    // Insert query
    $query= "INSERT INTO posts(title,author,body) VALUES('$title','$author','$body')";

    if(mysqli_query($conn, $query)){
        header('Location: '.ROOT_URL.'');
    } else {
        echo "ERROR: ".mysqli_error($conn);
    }
    }
?>

<?php include '../inc/header.php'; ?>
<?php include '../inc/navbar.php'; ?>
<div class='container'>
    <br>
    <h1>Add Post</h1>
    <form method='POST' action='<?php $_SERVER['PHP_SELF'];?>'>
        <div class='form-group'>
            <label>Title</label>
            <input type='text' name='title' class='form-control'>
            <hr>
        </div>
        <div class='form-group'>
            <label>Author</label>
            <input type='text' name='author' class='form-control'>
            <hr>
        </div>
        <div class='form-group'>
            <label>Body</label>
            <textarea name='body' class='form-control'></textarea>
            <hr>
        </div>
        <input type='submit' value='submit' name='submit_add' class='btn btn-primary'>
    </form>
</div>
<?php include '../inc/footer.php'; ?>