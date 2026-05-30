<?php
  include_once __DIR__ . "/../../config/db.php";

  $username = $_POST['username'];
  $fullname = $_POST['fullname'];
  $password = $_POST['password'];
  $phone = $_POST['phone_number'];
  $email = $_POST['email'];

  $query = "INSERT INTO users(username, fullname, password, phone_number, email)
    VALUE ('$username', '$fullname', '$password', '$phone', '$email')";

  mysqli_query($conn, $query);

  header("Location: users.php");
?>