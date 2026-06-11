<?php
include_once __DIR__ . "/../../includes/auth.php";

if (!isset($_SESSION['user_id'])) {
  header("Location: /POS_Final/auth/login.php");
  exit;
}

include_once __DIR__ . "/../../config/db.php";

$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);

ob_start();
?>

<div class="flex items-center justify-between mb-6">
  <div>
    <h1 class="text-3xl font-bold text-gray-800">
      POS - Point of Sales
    </h1>
  </div>
</div>

<div class="bg-white rounded-2xl shadow-sm overflow-y-scroll">
  <div class="grid grid-cols-12 gap-6 flex-1 min-h-0">

    <!-- Products -->
    <div class="col-span-8 bg-white rounded-2xl shadow-sm p-6 overflow-y-scroll h-[780px]">
      <div class="grid grid-cols-4 gap-4">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
          <div class="border rounded-xl p-4 hover:shadow-md cursor-pointer transition">
            <div class="h-32 bg-gray-100 rounded-lg mb-3 flex justify-center items-center">
              <?php if (!empty($row['image'])): ?>
                <img src="/POS_Final/uploads/products/<?= htmlspecialchars($row['image']) ?>"
                  class="w-full h-full object-contain" alt="<?= htmlspecialchars($row['name']) ?>">
              <?php else: ?>
                <i class="fa-solid fa-box text-3xl text-gray-500"></i>
              <?php endif; ?>
            </div>

            <h3 class="font-semibold text-gray-800">
              <?= htmlspecialchars($row['name']) ?>
            </h3>

            <p class="text-sm text-gray-500">
              Stock: <?= $row['qty'] ?>
            </p>

            <p class="text-lg font-bold text-blue-600 mt-2">
              $<?= number_format($row['price'], 2) ?>
            </p>

            <button onclick="addToCart(<?= $row['id'] ?>, '<?= addslashes($row['name']) ?>', <?= $row['price'] ?>)"
              class="mt-auto bg-[#20496b] text-white py-2 px-2 rounded-lg hover:bg-[#18374f]">
              Add to Cart
            </button>
          </div>
        <?php endwhile; ?>
      </div>
    </div>

    <!-- Cart -->
    <div class="col-span-4 bg-white rounded-2xl shadow-sm p-6 flex flex-col overflow-y-scroll h-[780px]">

      <h2 class="text-xl font-semibold mb-4">Current Order</h2>

      <div id="cart-items" class="flex-1 overflow-y-auto">
        <p class="text-gray-400 text-center mt-10">
          No items selected
        </p>
      </div>

      <div class="border-t pt-4">
        <div class="flex justify-between font-bold text-lg">
          <span>Total</span>
          <span id="subtotal">$0.00</span>
        </div>

        <button onclick="checkout()" class="w-full mt-4 bg-[#20496b] text-white py-3 rounded-xl">
          Checkout
        </button>
      </div>

    </div>

  </div>
</div>

<script>
  function checkout() {
    let cart = JSON.parse(localStorage.getItem("pos_cart")) || [];

    if (cart.length === 0) {
      Swal.fire({
        position: 'top-end',
        icon: 'warning',
        title: 'Cart Is Empty',
        showConfirmButton: false,
        timer: 1500,
        toast: true
      });
      return;
    }

    fetch("checkout.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({ cart })
    })
      .then(res => res.json())
      .then(data => {

        if (data.success) {
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Checkout Complete',
            showConfirmButton: false,
            timer: 1500,
            toast: true
          });

          localStorage.removeItem("pos_cart");

          setTimeout(() => {
            location.reload();
          }, 1500);

        } else {
          Swal.fire({
            icon: "error",
            title: "Checkout Failed"
          });
        }

      })
      .catch(() => {
        Swal.fire({
          icon: "error",
          title: "Server Error"
        });
      });
  }
</script>


<?php
$content = ob_get_clean();

include_once __DIR__ . "/../../layout/admin-layout.php";
?>