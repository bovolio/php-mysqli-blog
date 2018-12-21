<?php if(isset($_SESSION["success1"])) { echo 
"<div class='alert alert-dismissible alert-success' name='alert-success'>
  <button type='button' class='close' data-dismiss='alert'>&times;</button>
  <strong>Well done!</strong> You have successfully created your post!
</div>";
unset($_SESSION['success1']);
 }elseif(isset($_SESSION["success2"])) { echo 
"<div class='alert alert-dismissible alert-success' name='alert-success'>
  <button type='button' class='close' data-dismiss='alert'>&times;</button>
  <strong>Well done!</strong> You have successfully edited your post!
</div>";
unset($_SESSION['success2']);
 }elseif(isset($_SESSION["success3"])) { echo 
"<div class='alert alert-dismissible alert-danger' name='alert-danger'>
  <button type='button' class='close' data-dismiss='alert'>&times;</button>
  <strong>Well done!</strong> You have successfully deleted your post!
</div>";
unset($_SESSION['success3']);
 };  
 ?>