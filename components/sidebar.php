<?php
$current_page = basename($_SERVER['PHP_SELF']);
$username = $_SESSION['username'] ?? 'Admin';
?>

<div class="w-64 bg-[#20496b] text-white p-6 flex flex-col">
  <h1 class="text-2xl font-bold mb-10 text-center">
    POS SYSTEM
  </h1>

  <ul class="space-y-2">
    <li>
      <a href="/POS_Final/admin/dashboard.php" class="flex items-center gap-3 p-3 rounded-lg transition
        <?= $current_page == 'dashboard.php' ? 'bg-white/20' : 'hover:bg-white/10' ?>">

        <i class="fa-solid fa-gauge"></i>
        Dashboard
      </a>
    </li>

    <li>
      <a href="/POS_Final/admin/users/users.php" class="flex items-center gap-3 p-3 rounded-lg transition
        <?= $current_page == 'users.php' ? 'bg-white/20' : 'hover:bg-white/10' ?>">

        <i class="fa-solid fa-users"></i>
        Users
      </a>
    </li>

    <li>
      <a href="/POS_Final/admin/products/products.php" class="flex items-center gap-3 p-3 rounded-lg transition
        <?= $current_page == 'products.php' ? 'bg-white/20' : 'hover:bg-white/10' ?>">

        <i class="fa-solid fa-box"></i>
        Products
      </a>
    </li>
  </ul>

  <div class="mt-auto bg-white/10 backdrop-blur-sm rounded-xl p-4 shadow-lg border border-white/20">
    <div class="flex items-center gap-3">
      <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
        <i class="fa-solid fa-user"></i>
      </div>

      <div>
        <p class="text-xs text-gray-300">Logged in as</p>
        <p class="font-semibold text-white">
          <?= htmlspecialchars($username) ?>
        </p>
      </div>
    </div>
  </div>
</div>