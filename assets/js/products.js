function getProductModal() {
  return document.getElementById("productModal");
}

window.openAddModal = function() {
  const modal = getProductModal();
  if (!modal) return;

  document.getElementById("productForm").action = "store_product.php";
  document.getElementById("modalTitle").innerText = "Add Product";

  document.getElementById("product_id").value = "";
  document.getElementById("name").value = "";
  document.getElementById("price").value = "";
  document.getElementById("qty").value = "";

  modal.classList.remove("hidden");
}

window.openEditModal = function(id, name, price, qty) {
  const modal = getProductModal();
  if (!modal) return;

  document.getElementById("productForm").action = "update_product.php";
  document.getElementById("modalTitle").innerText = "Edit Product";

  document.getElementById("product_id").value = id;
  document.getElementById("name").value = name;
  document.getElementById("price").value = price;
  document.getElementById("qty").value = qty;

  modal.classList.remove("hidden");
}

window.closeModal = function() {
  const modal = getProductModal();
  if (!modal) return;

  modal.classList.add("hidden");
}
