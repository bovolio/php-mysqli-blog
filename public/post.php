<?php
    require '../config/config.php';
    require '../config/db.php';

        // Check for submit
    if(isset($_POST['delete'])){
    // Form Variables
    /*$handle= fopen('../config/success.php','w');
    $txt= '<?php $success3="" ?>';
    fwrite($handle, $txt);
    fclose($handle); */
    $delete_id= mysqli_real_escape_string($conn, $_POST['delete_id']);
    // Insert query
    $query= "DELETE FROM posts WHERE id = {$delete_id}";
    //die($query);
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
    <div class='container jumbotron'>
    <h1 class='display-3'> <?php echo $post['title']; ?> </h1>
            <small>Created at: <?php echo $post['timestamp']; ?> by <?php echo $post['author']; ?></small>
            <p class='lead'><?php echo $post['body']; ?></p>
            <hr>
            <div class='btn-toolbar container'>
            <a href="<?php echo ROOT_URL.'/editpost.php?id='.$post['id']?>" class='btn btn-info'>Edit</a>
            <?php if($idback !== 0) echo "<a class='btn btn-primary' href='/post.php?id=".$idback."'>Back</a>" ; ?>
            <?php if($idfwd !== ($num_rows + 1)) echo "<a class='btn btn-primary' href='/post.php?id=".$idfwd."'>Next</a>" ; ?>   
            <form class="right" method='POST' action="<?php echo $_SERVER['PHP_SELF'];?>">
            <input type="hidden" name="delete_id" value="<?php echo $post['id'];?>">
            <input type="submit" name='delete' value='Delete' class='btn btn-danger'>
            </form>
            </div>
    </div>

<?php include '../inc/footer.php'; ?>