<?php 
    require 'config/config.php';

//creat mysql connection

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(mysqli_connect_errno()){
    echo 'FAILED TO CONNECT TO MYSQL ' . mysqli_connect_errno();
}

?>