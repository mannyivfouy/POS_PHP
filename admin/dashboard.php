<?php
  include_once __DIR__ . "/../includes/auth.php";
  include_once __DIR__ . "/../config/db.php";

  $userResult = mysqli_query($conn, "SELECT COUNT(*) AS Total FROM users");
  $totalUsers = mysqli_fetch_assoc($userResult)['Total'];

  $productResult = mysqli_query($conn, "SELECT COUNT(*) AS Total FROM products");
  $totalProducts = mysqli_fetch_assoc($productResult)['Total'];
  ob_start();
?>

<div class="flex items-center justify-between mb-6">
  <div>
    <h1 class="text-3xl font-bold text-gray-800">
      Dashboard
    </h1>
  </div>
</div>

<div class="flex flex-wrap gap-6">

  <!-- Users Card -->
  <div class="bg-white rounded-2xl shadow-sm p-6 w-64">
    <div class="text-gray-500 text-sm">Total Users</div>
    <div class="text-3xl font-bold text-gray-800 mt-2">
      <?= $totalUsers ?>
    </div>
  </div>

  <!-- Products Card -->
  <div class="bg-white rounded-2xl shadow-sm p-6 w-64">
    <div class="text-gray-500 text-sm">Total Products</div>
    <div class="text-3xl font-bold text-gray-800 mt-2">
      <?= $totalProducts ?>
    </div>
  </div>

</div>

<?php
  $content = ob_get_clean();
  include_once __DIR__ . "/../layout/admin-layout.php";
?>

