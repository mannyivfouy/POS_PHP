<?php
include_once __DIR__ . "/../../includes/auth.php";

if (!isset($_SESSION['user_id'])) {
  header("Location: /POS_Final/auth/login.php");
  exit;
}

include_once __DIR__ . "/../../config/db.php";

$query = "SELECT * FROM sales ORDER BY id DESC";
$result = mysqli_query($conn, $query);
$no = 1;

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
  <div class="overflow-x-auto max-h-[750px] overflow-y-auto">
    <table class="w-full">
      <thead class="bg-gray-200 bg-gray-200 sticky top-0">
        <tr class="text-left text-gray-600 text-sm uppercase">
          <th class="p-4">ID</th>
          <th class="p-4">Total</th>
          <th class="p-4">Date</th>
          <th class="p-4">Action</th>
        </tr>
      </thead>

      <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
          <tr class="border-t">
            <td class="p-4">
              <?php echo $no++ ; ?>
            </td>
            <td class="p-4">$
              <?= $row['total'] ?>
            </td>
            <td class="p-4 text-gray-500">
              <?php echo date('d M Y', strtotime($row['created_at'])) ?>
            </td>
            <td class="p-4">
              <button onclick="viewSale(<?= $row['id'] ?>)"
                class="w-10 h-10 rounded-lg bg-green-100 text-green-600 flex items-center justify-center hover:bg-green-200">
                <i class="fa-solid fa-receipt"></i>
              </button>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Sale Modal -->
<div id="saleModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">

  <div class="bg-white w-[900px] p-6 rounded-2xl shadow-lg">

    <div class="flex justify-between items-center mb-4">
      <h2 class="text-xl font-bold">Sale Details</h2>

      <button onclick="closeSaleModal()"
        class="text-gray-500 w-10 h-10 bg-red-100 hover:bg-red-200 rounded-lg text-red-600">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <div id="saleContent">
      Loading...
    </div>

  </div>
</div>

<script>
  function viewSale(id) {
    document.getElementById('saleModal').classList.remove('hidden');

    fetch(`sale_detail.php?id=${id}`)
      .then(res => res.json())
      .then(data => {

        let html = `
          <div class="mb-6 border-b pb-4">
            
            <div class="flex items-center mb-2">
              <h2 class="text-lg font-bold text-gray-800 mr-3">Sale Receipt</h2>
              <span class="text-sm text-gray-500">#${data.sale.id}</span>
            </div>

            <div class="flex items-center mb-2>
              <h2 class="text-lg font-bold text-gray-800 mr-3"> Date </h2>
              <span class="text-sm text-gray-500">${data.sale.created_at}</span>
            </div>

            <p class="text-lg font-bold text-[#20496B] mt-2">
              Total: $${data.sale.total}
            </p>
          </div>

          <div class="overflow-hidden rounded-xl border">
            <table class="w-full text-sm">
              
              <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                  <th class="p-3 text-left">Product</th>
                  <th class="p-3 text-center">Qty</th>
                  <th class="p-3 text-right">Price</th>
                  <th class="p-3 text-right">Total</th>
                </tr>
              </thead>

              <tbody class="divide-y">
        `;

        data.items.forEach(item => {
          html += `
            <tr class="hover:bg-gray-50">
              <td class="p-3 font-medium text-gray-800">${item.name}</td>
              <td class="p-3 text-center">${item.qty}</td>
              <td class="p-3 text-right">$${item.price}</td>
              <td class="p-3 text-right font-semibold text-gray-700">
                $${item.qty * item.price}
              </td>
            </tr>
          `;
        });

        html += `</tbody></table>`;

        document.getElementById('saleContent').innerHTML = html;
      });
  }

  function closeSaleModal() {
    document.getElementById('saleModal').classList.add('hidden');
  }
</script>

<?php
$content = ob_get_clean();

include_once __DIR__ . "/../../layout/admin-layout.php";
?>