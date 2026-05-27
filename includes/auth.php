<?php
  session_start();

  if(!isset($_SESSION['user_id'])){
    header("Location: /POS_Final/auth/login.php");
    exit;
  }
?>