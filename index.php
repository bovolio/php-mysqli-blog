<?php
    require 'config/config.php';
    require 'config/db.php';
    include 'config/success.php';
$query = 'SELECT * FROM posts ORDER BY timestamp DESC';
// TODO: ADD VALIDATION FOR FORMS

// GET RESULTS

$result = mysqli_query($conn, $query);

// FETCH DATA

$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
//var_dump($posts);
// FREE RESULT

mysqli_free_result($result);

// CLOSE CONNECTION

mysqli_close($conn);
?>

<?php include 'inc/header.php'; ?>
<?php include 'inc/navbar.php'; ?>
<?php if(isset($success)) { echo 
"<div class='alert alert-dismissible alert-success' name='alert-success'>
  <button type='button' class='close' data-dismiss='alert'>&times;</button>
  <strong>Well done!</strong> You have successfully created your post!
</div>";
unlink('config/success.php');
 } ?>
 <?php if(isset($success2)) { echo 
"<div class='alert alert-dismissible alert-success' name='alert-success'>
  <button type='button' class='close' data-dismiss='alert'>&times;</button>
  <strong>Well done!</strong> You have successfully edited your post!
</div>";
unlink('config/success.php');
 } ?>

 <?php if(isset($success3)) { echo 
"<div class='alert alert-dismissible alert-danger' name='alert-danger'>
  <button type='button' class='close' data-dismiss='alert'>&times;</button>
  <strong>Well done!</strong> You have successfully deleted your post!
</div>";
unlink('config/success.php');
 } ?>
    <div class='container'>
    <br>
    <h1>Posts</h1>
    <hr>
    <?php foreach($posts as $post) : ?>
        <div class="well">
            <h3><?php echo $post['title']; ?></h3>
            <small>Created at: <?php echo $post['timestamp']; ?> by <?php echo $post['author']; ?></small>
            <p><?php echo $post['body']; ?></p>
            <a class='btn btn-primary' href="post.php?id=<?php echo $post['id'] ?>">Read More</a>
        </div>
        <br>
        <hr>
    <?php endforeach; ?>
<br>
<?php foreach($posts as $post) : ?>
<div class="list-group">
  <a href="post.php?id=<?php echo $post['id'] ?>" class="list-group-item list-group-item-action flex-column align-items-start">
    <div class="d-flex w-100 justify-content-between">
      <h2 class="mb-1"><?php echo $post['title']; ?></h2>
      <small>Created at: <?php echo $post['timestamp']; ?></small>
    </div>
    <p class="mb-1"><?php echo $post['body']; ?></small>
  </a>
</div>
<?php endforeach; ?>

<?php include 'inc/footer.php'; ?>