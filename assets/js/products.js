function openAddModal() {
  document.getElementById("productForm").action = "store_product.php";
  document.getElementById("modalTitle").innerText = "Add Product";

  document.getElementById("product_id").value = "";
  document.getElementById("name").value = "";
  document.getElementById("price").value = "";
  document.getElementById("qty").value = "";

  document.getElementById("productModal").classList.remove("hidden");
}

function openEditModal(id, name, price, qty) {
  document.getElementById("productForm").action = "update_product.php";
  document.getElementById("modalTitle").innerText = "Edit Product";

  document.getElementById("product_id").value = id;
  document.getElementById("name").value = name;
  document.getElementById("price").value = price;
  document.getElementById("qty").value = qty;

  document.getElementById("productModal").classList.remove("hidden");
}

function closeModal() {
  document.getElementById("productModal").classList.add("hidden");
}
