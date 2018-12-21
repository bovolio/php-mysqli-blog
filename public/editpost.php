<?php
    require '../config/config.php';
    require '../config/db.php';

    // Check for submit
    if(isset($_POST['submit'])){
    // Form Variables
    $handle= fopen('../config/success.php','w');
    $txt= '<?php $success2="" ?>';
    fwrite($handle, $txt);
    fclose($handle);
    $update_id= mysqli_real_escape_string($conn, $_POST['update_id']);
    $title= mysqli_real_escape_string($conn, $_POST['title']);
    $body= mysqli_real_escape_string($conn, $_POST['body']);
    $author= mysqli_real_escape_string($conn, $_POST['author']);
    
    // Insert query
    $query= "UPDATE posts SET 
                    title='$title', 
                    author='$author', 
                    body='$body' 
                    WHERE id = {$update_id}";
    
    if(mysqli_query($conn, $query)){
        header('Location: '.ROOT_URL.'');
    } else {
        echo "ERROR: ".mysqli_error($conn);
    }
}
    // GET ID

$id = mysqli_real_escape_string($conn, $_GET['id']);
$idback = (mysqli_real_escape_string($conn, $_GET['id']) - 1);
$idfwd = (mysqli_real_escape_string($conn, $_GET['id']) + 1);
// GET QUERY

$query = "SELECT * FROM posts WHERE id =".$id;
$query2 = "SELECT * FROM posts";

// GET RESULTS

$result = mysqli_query($conn,$query);

$result2 = mysqli_query($conn,$query2);

// GET NUM ROWS

$num_rows = mysqli_num_rows($result2);

// FETCH DATA

$post = mysqli_fetch_assoc($result);
//var_dump($posts);
// FREE RESULT

mysqli_free_result($result);

// CLOSE CONNECTION

mysqli_close($conn);

?>

<?php include '../inc/header.php'; ?>
<?php include '../inc/navbar.php'; ?>
<div class='container'>
    <br>
    <h1>Edit Post</h1>
    <form method='POST' action='<?php $_SERVER['PHP_SELF'];?>'>
        <div class='form-group'>
            <label>Title</label>
            <input type='text' name='title' class='form-control' value= "<?php echo $post['title']; ?>">
            <hr>
        </div>
        <div class='form-group'>
            <label>Author</label>
            <input type='text' name='author' class='form-control'value="<?php echo $post['author'];?>">
            <hr>
        </div>
        <div class='form-group'>
            <label>Body</label>
            <textarea name='body' class='form-control'><?php echo $post['body'];?></textarea>
            <hr>
        </div>
        <input type="hidden" name='update_id' value="<?php echo $post['id'];?>">
        <input type='submit' value='submit' name='submit' class='btn btn-primary'>
    </form>
</div>
<?php include '../inc/footer.php'; ?>