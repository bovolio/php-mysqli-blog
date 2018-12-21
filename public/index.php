<?php
session_start();

    require "../config/config.php";
    require '../config/db.php';

$query = 'SELECT * FROM posts ORDER BY timestamp DESC';
// TODO: ADD VALIDATION FOR FORMS IN BACKEND
// TODO: ADD NOTIFICATIONS USING SESSIONS

// GET RESULTS

$result = mysqli_query($conn, $query);

// FETCH DATA

$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

// FREE RESULT

mysqli_free_result($result);

// CLOSE CONNECTION

mysqli_close($conn);
?>

<?php require '../inc/header.php'; ?>
<?php require '../inc/navbar.php'; ?>
<?php include '../inc/notifications.php'; ?>
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

<?php include '../inc/footer.php'; ?>