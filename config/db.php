<?php
  $hostname = "localhost";
  $username = 'root';
  $password = "";
  $database = "php_pos";

  $conn = mysqli_connect($hostname, $username, $password, $database);

  if(!$conn){
    die("Connection Failed : " . mysqli_connect_errno() . mysqli_connect_error());
  }
?>