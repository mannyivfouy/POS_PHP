function getProductModal() {
  return document.getElementById("productModal");
}

window.openProductModal = function () {
  const modal = getProductModal();
  if (!modal) return;

  document.getElementById("productForm").action = "store_product.php";
  document.getElementById("modalTitle").innerText = "Add Product";

  document.getElementById("product_id").value = "";
  document.getElementById("name").value = "";
  document.getElementById("price").value = "";
  document.getElementById("qty").value = "";

  modal.classList.remove("hidden");
};

window.openEditProductModal = function (id, name, price, qty) {
  const modal = getProductModal();
  if (!modal) return;

  document.getElementById("productForm").action = "update_product.php";
  document.getElementById("modalTitle").innerText = "Edit Product";

  document.getElementById("product_id").value = id;
  document.getElementById("name").value = name;
  document.getElementById("price").value = price;
  document.getElementById("qty").value = qty;

  modal.classList.remove("hidden");
};

window.closeProductModal = function () {
  const modal = getProductModal();
  if (!modal) return;

  modal.classList.add("hidden");
};

let cart = []; // ✅ GLOBAL

window.addEventListener("DOMContentLoaded", function () {
  window.addToCart = function (id, name, price, qty) {
    console.log("ADD TO CART WORKS:", id);

    const existing = cart.find((item) => item.id === id);

    if (existing) {
      existing.qty += 1;
    } else {
      cart.push({
        id,
        name,
        price,
        qty: 1,
      });
    }

    renderCart();
  };
});

window.renderCart = function() {
  const cartBox = document.getElementById("cart-items");
  const subtotalBox = document.getElementById("subtotal");

  cartBox.innerHTML = "";

  let total = 0;

  cart.forEach((item) => {
    total += item.price * item.qty;

    cartBox.innerHTML += `
      <div class="flex justify-between border-b py-2">
        <div>
          <p class="font-medium">${item.name}</p>
          <p class="text-sm text-gray-500">
            $${item.price} x ${item.qty}            
          </p>
        </div>

        <button onclick="removeItem(${item.id})"
          class="text-red-500 text-sm">
            <i class="fa-solid fa-x"></i>
        </button>
      </div>
    `;
  });

  subtotalBox.innerText = "$" + total.toFixed(2);
}

window.removeItem = function (id) {
  cart = cart.filter((item) => item.id !== id);
  renderCart();
};
