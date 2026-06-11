<?php
include_once __DIR__ . "/../../includes/auth.php";

if (!isset($_SESSION['user_id'])) {
  header("Location: /POS_Final/auth/login.php");
  exit;
}

include_once __DIR__ . "/../../config/db.php";

$query = "SELECT * FROM sales";
$result = mysqli_query($conn, $query);

ob_start();
?>

<div class="flex items-center justify-between mb-6">
  <div>
    <h1 class="text-3xl font-bold text-gray-800">
      Sales Report
    </h1>
  </div>
</div>

<div class="bg-white rounded-2xl shadow-sm overflow-hidden">
  <div class="overflow-x-auto mx-h-[750px] overflow-y-auto">
    <table class="w-full">
      <thead class="bg-gray-200 bg-gray-200 sticky top-0">
        <tr class="text-left text-gray-600 text-sm uppercase">
          <th class="p-4">ID</th>
          <th class="p-4">Total</th>
          <th class="p-4">Date</th>
        </tr>
      </thead>

      <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
          <tr class="border-t">
            <td class="p-2">#
              <?= $row['id'] ?>
            </td>
            <td class="p-2">$
              <?= $row['total'] ?>
            </td>
            <td class="p-2">
              <?= $row['created_at'] ?>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

<?php
$content = ob_get_clean();

include_once __DIR__ . "/../../layout/admin-layout.php";
?>