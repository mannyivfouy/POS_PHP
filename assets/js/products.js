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
  document.getElementById("image").value = "";
  document.getElementById("price").value = "";
  document.getElementById("qty").value = "";

  modal.classList.remove("hidden");
};

window.openEditProductModal = function (id, name, price, qty, image) {
  const modal = getProductModal();
  if (!modal) return;

  document.getElementById("productForm").action = "update_product.php";
  document.getElementById("modalTitle").innerText = "Edit Product";

  document.getElementById("product_id").value = id;
  document.getElementById("name").value = name;
  document.getElementById("image").value = "";
  document.getElementById("price").value = price;
  document.getElementById("qty").value = qty;

  const preview = document.getElementById("image_preview");
  if (image) {
    preview.src = "/POS_Final/uploads/products/" + image;
    preview.classList.remove("hidden");
  } else {
    preview.src = "";
    preview.classList.add("hidden");
  }

  modal.classList.remove("hidden");
};

window.closeProductModal = function () {
  const modal = getProductModal();
  if (!modal) return;

  modal.classList.add("hidden");
};

let cart = [];

window.addEventListener("DOMContentLoaded", function () {
  loadCart();
  renderCart();

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

    saveCart();
    renderCart();
  };
});

window.renderCart = function () {
  const cartBox = document.getElementById("cart-items");
  const subtotalBox = document.getElementById("subtotal");

  cartBox.innerHTML = "";

  let total = 0;

  cart.forEach((item) => {
    total += item.price * item.qty;

    cartBox.innerHTML += `
      <div class="flex items-center justify-between border-b py-2 gap-3">
        <div class="flex-1 min-w-0">
          <p class="font-medium truncate">${item.name}</p>
          <p class="text-sm text-gray-500">$${(item.price * item.qty).toFixed(2)}</p>
        </div>

        <div class="flex items-center gap-2 shrink-0">
          <button onclick="changeQty(${item.id}, -1)"
            class="w-6 h-6 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-600 text-xs flex items-center justify-center">
            <i class="fa-solid fa-minus"></i>
          </button>

          <span class="text-sm font-medium w-4 text-center">${item.qty}</span>

          <button onclick="changeQty(${item.id}, 1)"
            class="w-6 h-6 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-600 text-xs flex items-center justify-center">
            <i class="fa-solid fa-plus"></i>
          </button>

          <button onclick="removeItem(${item.id})"
            class="w-6 h-6 rounded-full bg-red-100 hover:bg-red-200 text-red-500 text-xs flex items-center justify-center ml-1">
            <i class="fa-solid fa-trash"></i>
          </button>
        </div>
      </div>
    `;
  });

  subtotalBox.innerText = "$" + total.toFixed(2);
};

function saveCart() {
  localStorage.setItem("pos_cart", JSON.stringify(cart));
}

function loadCart() {
  const saved = localStorage.getItem("pos_cart");
  cart = saved ? JSON.parse(saved) : [];
}

function clearCart() {
  cart = [];
  saveCart();
  renderCart();
}

window.changeQty = function (id, delta) {
  const item = cart.find((i) => i.id === id);
  if (!item) return;

  item.qty += delta;

  if (item.qty <= 0) {
    cart = cart.filter((i) => i.id !== id);
  }

  saveCart();
  renderCart();
};

window.removeItem = function (id) {
  cart = cart.filter((item) => item.id !== id);
  
  saveCart();
  renderCart();
};
