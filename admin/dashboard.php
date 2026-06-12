<?php
  include_once __DIR__ . "/../includes/auth.php";
  include_once __DIR__ . "/../config/db.php";

  $userResult = mysqli_query($conn, "SELECT COUNT(*) AS Total FROM users");
  $totalUsers = mysqli_fetch_assoc($userResult)['Total'];

  $productResult = mysqli_query($conn, "SELECT COUNT(*) AS Total FROM products");
  $totalProducts = mysqli_fetch_assoc($productResult)['Total'];

  $saleResult = mysqli_query($conn, "SELECT COUNT(*) AS Total FROM sales");
  $totalSales = mysqli_fetch_assoc($saleResult)['Total'];

  $totalIncomeResult = mysqli_query($conn, "SELECT SUM(total) AS Total FROM sales");
  $totalIncome = mysqli_fetch_assoc($totalIncomeResult)['Total'];
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
    <div class="text-3xl font-bold text-gray-800 mt-2 flex justify-between">
      <i class="fa-solid fa-users text-[#20496B]"></i>
      <?= $totalUsers ?>
    </div>
  </div>

  <!-- Products Card -->
  <div class="bg-white rounded-2xl shadow-sm p-6 w-64">
    <div class="text-gray-500 text-sm">Total Products</div>
    <div class="text-3xl font-bold text-gray-800 mt-2 flex justify-between">
      <i class="fa-solid fa-box text-[#20496B]"></i>
      <?= $totalProducts ?>
    </div>
  </div>

  <!-- Sales Card -->
  <div class="bg-white rounded-2xl shadow-sm p-6 w-64">
    <div class="text-gray-500 text-sm">Total Sales</div>
    <div class="text-3xl font-bold text-gray-800 mt-2 flex justify-between">
      <i class="fa-solid fa-receipt text-[#20496B]"></i>
      <?= $totalSales ?>
    </div>
  </div>

  <div class="bg-white rounded-2xl shadow-sm p-6 w-64">
    <div class="text-gray-500 text-sm">Total Income</div>
    <div class="text-3xl font-bold text-gray-800 mt-2 flex justify-between">
      <i class="fa-solid fa-money-bill-trend-up text-[#20496B]"></i>
      $ <?= $totalIncome ?>
    </div>
  </div>

</div>

<?php
  $content = ob_get_clean();
  include_once __DIR__ . "/../layout/admin-layout.php";
?>

