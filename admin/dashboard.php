<?php
  include_once __DIR__ . "/../includes/auth.php";
  ob_start();
  ?>

  <h1 class="text-3xl font-bold text-gray-800">
    Dashboard
  </h1>

  <p class="text-gray-600 mt-2">
    Welcome to your POS system
  </p>

  <?php
  $content = ob_get_clean();
  include_once __DIR__ . "/../layout/admin-layout.php";
?>