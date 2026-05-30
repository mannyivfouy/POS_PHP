<?php
include_once __DIR__ . "/../../includes/auth.php";

if (!isset($_SESSION['user_id'])) {
  header("Location: /POS_Final/auth/login.php");
  exit;
}

include_once __DIR__ . "/../../config/db.php";

$no = 1;
$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);

ob_start();
?>

<div class="flex items-center justify-between mb-6">
  <div>
    <h1 class="text-3xl font-bold text-gray-800">
      Products
    </h1>
  </div>

  <a href="#" onclick="openProductModal(); return false;"
    class="bg-[#20496b] hover:bg-[#17364f] text-white px-5 py-3 rounded-xl font-medium transition">
    <i class="fa-solid fa-plus mr-2"></i>
    Add Product
  </a>
</div>

<!-- Product Table -->
<div class="bg-white rounded-2xl shadow-sm overflow-hidden">

  <!-- <div class="p-5 border-b">
    <div class="relative w-80">
      <span class="absolute left-4 top-3 text-gray-400">
        <i class="fa-solid fa-magnifying-glass"></i>
      </span>

      <input type="text" placeholder="Search product..."
        class="w-full border border-gray-300 rounded-xl py-3 pl-11 pr-4 focus:outline-none focus:ring-2 focus:ring-[#20496b]">
    </div>
  </div> -->

  <div class="overflow-x-auto">
    <table class="w-full">
      <thead class="bg-gray-200">
        <tr class="text-left text-gray-600 text-sm uppercase">
          <th class="p-4">#</th>
          <th class="p-4">Product</th>
          <th class="p-4">Price</th>
          <th class="p-4">Quantity</th>
          <th class="p-4">Amount</th>
          <th class="p-4">Created At</th>
          <th class="p-4">Updated At</th>
          <th class="p-4 text-center">Action</th>
        </tr>
      </thead>

      <tbody>
        <?php if (mysqli_num_rows($result) > 0) { ?>

          <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr class="border-b hover:bg-gray-50 transition">

              <td class="p-4 font-medium text-gray-700">
                <?php echo $no++; ?>
              </td>

              <td class="p-4">
                <div class="flex items-center gap-3">

                  <div class="w-12 h-12 bg-gray-200 rounded-xl flex items-center justify-center text-gray-500">
                    <i class="fa-solid fa-box"></i>
                  </div>

                  <div>
                    <h3 class="font-semibold text-gray-800">
                      <?php echo $row['name']; ?>
                    </h3>
                  </div>

                </div>
              </td>

              <td class="p-4 text-gray-700">
                $
                <?php echo number_format($row['price'], 2); ?>
              </td>

              <td class="p-4">
                <?php if ($row['qty'] <= 0) { ?>
                  <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                    Out of Stock
                  </span>

                <?php } elseif ($row['qty'] < 50) { ?>
                  <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                    <?php echo $row['qty']; ?> Low Stock
                  </span>

                <?php } else { ?>
                  <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                    <?php echo $row['qty']; ?> In Stock
                  </span>
                <?php } ?>
              </td>

              <td class="p-4">
                $
                <?php echo $row['amount'] ?>
              </td>

              <td class="p-4 text-gray-500">
                <?php echo date('d M Y', strtotime($row['created_at'])); ?>
              </td>

              <td class="p-4 text-gray-500">
                <?php echo date('d M Y', strtotime($row['updated_at'])); ?>
              </td>

              <td class="p-4">
                <div class="flex items-center justify-center gap-2">

                  <a href="edit_product.php?id=<?= $row['id'] ?>" onclick="openEditProductModal(
                      <?= $row['id'] ?>,
                      '<?= addslashes($row['name']) ?>',
                      <?= $row['price'] ?>,
                      <?= $row['qty'] ?>
                    ); return false;"
                    class="w-10 h-10 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center hover:bg-blue-200 transition">
                    <i class="fa-solid fa-pen"></i>
                  </a>

                  <a href="delete_product.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this product?')"
                    class="w-10 h-10 rounded-lg bg-red-100 text-red-600 flex items-center justify-center hover:bg-red-200 transition">

                    <i class="fa-solid fa-trash"></i>
                  </a>
                </div>
              </td>
            </tr>
          <?php } ?>
        <?php } else { ?>

          <tr>
            <td colspan="6" class="p-10 text-center text-gray-500">
              No products found
            </td>
          </tr>

        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Modal -->
<div id="productModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">

  <div class="bg-white w-96 p-6 rounded-2xl shadow-lg">

    <h2 id="modalTitle" class="text-xl font-bold mb-4">Add Product</h2>

    <form id="productForm" method="POST">

      <input type="hidden" name="id" id="product_id">

      <div>
        <label for="name" class="block mb-2 text-gray-700 font-medium">
          Product Name
        </label>
        <div class="relative">
          <span class="absolute left-4 top-3 text-gray-400">
            <i class="fa-solid fa-box"></i>
          </span>

          <input type="text" name="name" id="name" placeholder="Enter Product Name"
            class="w-full border border-gray-300 rounded-xl py-3 pl-12 pr-4 focus:outline-none focus:ring-2 focus:ring-[#20496b] mb-5">
        </div>
      </div>

      <div>
        <label for="price" class="block mb-2 text-gray-700 font-medium">
          Product Price
        </label>
        <div class="relative">
          <span class="absolute left-4 top-3 text-gray-400">
            <i class="fa-solid fa-dollar-sign"></i>
          </span>

          <input type="text" name="price" id="price" placeholder="Enter Product Name"
            class="w-full border border-gray-300 rounded-xl py-3 pl-12 pr-4 focus:outline-none focus:ring-2 focus:ring-[#20496b] mb-5">
        </div>
      </div>

      <div>
        <label for="qty" class="block mb-2 text-gray-700 font-medium">
          Product Quantity
        </label>
        <div class="relative">
          <span class="absolute left-4 top-3 text-gray-400">
            <i class="fa-solid fa-0"></i>
          </span>

          <input type="text" name="qty" id="qty" placeholder="Enter Product Quantity"
            class="w-full border border-gray-300 rounded-xl py-3 pl-12 pr-4 focus:outline-none focus:ring-2 focus:ring-[#20496b] mb-5">
        </div>
      </div>

      <div class="flex justify-end gap-2">

        <button type="button" onclick="closeProductModal()" class="px-4 py-2 bg-red-500 text-white rounded">
          Cancel
        </button>

        <button type="submit" class="px-4 py-2 bg-[#20496B] text-white rounded">
          Save
        </button>

      </div>

    </form>

  </div>
</div>

<?php
$content = ob_get_clean();

include_once __DIR__ . "/../../layout/admin-layout.php";
?>