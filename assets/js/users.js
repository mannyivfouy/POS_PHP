window.openUserModal = function () {
  const modal = document.getElementById("userModal");
  if (!modal) return;

  document.getElementById("userForm").action = "store_user.php";
  document.getElementById("modalTitle").innerText = "Add User";

  document.getElementById("user_id").value = "";
  document.getElementById("username").value = "";
  document.getElementById("fullname").value = "";
  document.getElementById("password").value = "";
  document.getElementById("phone_number").value = "";
  document.getElementById("email").value = "";

  modal.classList.remove("hidden");
};

window.openEditUserModal = function (id, username, fullname, phone, email) {
  const modal = document.getElementById("userModal");
  if (!modal) return;

  document.getElementById("userForm").action = "update_user.php";
  document.getElementById("modalTitle").innerText = "Edit User";

  document.getElementById("user_id").value = id;
  document.getElementById("username").value = username;
  document.getElementById("fullname").value = fullname;
  document.getElementById("phone_number").value = phone;
  document.getElementById("email").value = email;

  modal.classList.remove("hidden");
};

window.closeUserModal = function () {
  const modal = document.getElementById("userModal");
  if (!modal) return;

  modal.classList.add("hidden");
};
