<?php
  include_once __DIR__ . "/../includes/auth.php";
  ob_start();
?>

<div class="flex items-center justify-between mb-6">
  <div>
    <h1 class="text-3xl font-bold text-gray-800">
      Dashboard
    </h1>
  </div>
</div>

<div class="flex">
  <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
    
  </div>  
</div>

<?php
  $content = ob_get_clean();
  include_once __DIR__ . "/../layout/admin-layout.php";
?>

