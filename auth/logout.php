<?php
  session_unset();

  session_destroy();

  header("Location: /POS_Final/auth/login.php");
  exit;
?>