<?php
  include_once __DIR__ . "/../../config/db.php";

  $id = $_POST['id'];
  $username = $_POST['username'];
  $fullname = $_POST['fullname'];
  $password = $_POST['password'];
  $phone = $_POST['phone_number'];
  $email = $_POST['email'];

  $query = "UPDATE users SET 
    username = '$username', fullname = '$fullname', password = '$password',
    phone_number = '$phone', email = '$email'
  WHERE id = $id";

  mysqli_query($conn, $query);

  header("Location: users.php");
?>