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
  <a class="navbar-brand" style='color:#8FF43C' href="<?php echo ROOT_URL; ?>"><b>PHP Blog</b></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor02">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo ROOT_URL; ?>">Home<span class="sr-only">(current)</span></a>
      </li>
      <?php if($_SESSION["loggedin"] == true){ ?>
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo ROOT_URL.'/addpost.php';?>">Add Post<span class="sr-only">(current)</span></a>
      </li>
      <?php }; ?>
      </ul>
      <?php if($_SESSION["loggedin"] == false){ ?>
      <ul style='list-style-type: none;'>
      <li style='float: right;' class="nav-item active" style='list-style-type: none;'>
        <a class="nav-link" style='color:#fff' href="<?php echo ROOT_URL.'/register.php'; ?>">Register<span class="sr-only">(current)</span></a>
      </li>
      <li style='float: right;' class="nav-item active" style='list-style-type: none;'>
        <a class="nav-link" style='color:#fff' href="<?php echo ROOT_URL.'/login.php'; ?>">Log in<span class="sr-only">(current)</span></a>
      </li>
    </ul>
      <?php }else{?>
        <ul style='list-style-type: none;'>
        <li style='float: right;' class="nav-item active" style='list-style-type: none;'>
        <a class="nav-link" style='color:#fff' href="<?php echo ROOT_URL.'/profile.php'; ?>">Profile<span class="sr-only">(current)</span></a>
      </li>
      <li style='float: right;' class="nav-item active" style='list-style-type: none;'>
        <a class="nav-link" style='color:#fff' href="<?php echo ROOT_URL.'/logout.php'; ?>">Log Out<span class="sr-only">(current)</span></a>
      </li>
      </ul> <?php }?>      
  </div>
</nav>