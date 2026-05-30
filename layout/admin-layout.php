<?php
  // session_start();

  if(!isset($_SESSION['user_id'])){
    header("Location: /POS_Final/auth/login.php");
    exit;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link rel="stylesheet" href="/POS_Final/assets/css/style.css">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
  <?php include_once __DIR__ . "/../components/header.php"?>

  <div class="flex flex-1">
    <?php include_once __DIR__ . "/../components/sidebar.php"; ?>

    <div class="flex-1 flex flex-col">

      <?php include_once __DIR__ . "/../components/navbar.php"; ?>

      <main class="p-6">
        <?php echo $content ?? ''; ?>
      </main>
    </div>
  </div>

  <script src="/POS_Final/assets/js/products.js"></script>
  <!-- <script src="/POS_Final/assets/js/users.js"></script> -->
</body>
</html>