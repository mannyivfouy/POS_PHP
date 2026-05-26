<div class="bg-white shadow px-6 py-4 flex justify-between items-center">
  <h2 class="text-lg font-semibold text-gray-700">
    Admin Panel
  </h2>
  

  <div class="flex items-center gap-4">
    <span class="text-gray-600">
      <?= $_SESSION['username']; ?>
    </span>

    <a href="../logout.php" class="bg-red-500 text-white px-4 py-2 rounded-xl hover:bg-red-600">
      Logout
    </a>
  </div>
</div>