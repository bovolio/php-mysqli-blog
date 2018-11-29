<?php 
if(isset($_POST['submit-search'])){
  $id = mysqli_real_escape_string($conn, $_GET['id']);
  $query = "SELECT * FROM posts WHERE id =".$id;
  $result = mysqli_query($conn,$query);
  $post = mysqli_fetch_assoc($result);
  mysqli_free_result($result);

}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="<?php echo ROOT_URL.'index.php'; ?>">PHP Blog</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor02">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo ROOT_URL.'index.php'; ?>">Home<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo ROOT_URL;?>addpost.php">Add Post<span class="sr-only">(current)</span></a>
      </li>
      </ul>
      <ul>
      <li style='float: right;' class="nav-item active">
        <a class="nav-link" href="<?php echo ROOT_URL.'register.php'; ?>">Register<span class="sr-only">(current)</span></a>
      </li>
    </ul>

  </div>
</nav>