<?php
  $current_page = basename($_SERVER['PHP_SELF']);
?>

<div class="w-64 bg-[#20496b] text-white p-6">
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

    <!-- <li>
      <a href="pos.php" class="flex items-center gap-3 p-3 rounded-lg transition
         <?= $current_page == 'pos.php' ? 'bg-white/20' : 'hover:bg-white/10' ?>">

        <i class="fa-solid fa-cart-shopping"></i>
        POS
      </a>
    </li> -->

    <!-- <li>
      <a href="orders.php" class="flex items-center gap-3 p-3 rounded-lg transition
         <?= $current_page == 'orders.php' ? 'bg-white/20' : 'hover:bg-white/10' ?>">

        <i class="fa-solid fa-cart-shopping"></i>
        Orders
      </a>
    </li> -->
  </ul>
</div>