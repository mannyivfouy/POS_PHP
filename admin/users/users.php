<?php

include_once __DIR__ . "/../../includes/auth.php";

if (!isset($_SESSION['user_id'])) {
  header("Location: /POS_Final/auth/login.php");
  exit;
}

include_once __DIR__ . "/../../config/db.php";

$no = 1;
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

ob_start();
?>

<div class="flex items-center justify-between mb-6">
  <div>
    <h1 class="text-3xl font-bold text-gray-800">
      Users
    </h1>
  </div>

  <button href="#" onclick="openUserModal(); return false;"
    class="bg-[#20496b] hover:bg-[#17364f] text-white px-5 py-3 rounded-xl font-medium transition">

    <i class="fa-solid fa-plus mr-2"></i>
    Add User
  </button>
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

  <div class="overflow-x-auto max-h-[750px] overflow-y-auto">
    <table class="w-full">
      <thead class="bg-gray-200 sticky top-0">
        <tr class="text-left text-gray-600 text-sm uppercase">
          <th class="p-4">#</th>
          <th class="p-4">Username</th>
          <th class="p-4">FullName</th>
          <th class="p-4">Phone Number</th>
          <th class="p-4">Email</th>
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
                    <i class="fa-solid fa-user"></i>
                  </div>

                  <div>
                    <h3 class="font-semibold text-gray-800">
                      <?php echo $row['username']; ?>
                    </h3>
                  </div>

                </div>
              </td>

              <td class="p-4 text-gray-500">
                <?php echo $row['fullname'] ?>
              </td>

              <td class="p-4 text-gray-500">
                <?php echo $row['phone_number']; ?>
              </td>

              <td class="p-4 text-gray-500">
                <?php echo $row['email']; ?>
              </td>

              <td class="p-4 text-gray-500">
                <?php echo date('d M Y', strtotime($row['created_at'])); ?>
              </td>

              <td class="p-4 text-gray-500">
                <?php echo date('d M Y', strtotime($row['updated_at'])); ?>
              </td>

              <td class="p-4">
                <div class="flex items-center justify-center gap-2">

                  <a href="#" onclick="openEditUserModal(
                      <?= $row['id'] ?>,
                      '<?= addslashes($row['username']) ?>',
                      '<?= addslashes($row['fullname']) ?>',
                      '<?= addslashes($row['password']) ?>',
                      '<?= addslashes($row['phone_number']) ?>',
                      '<?= addslashes($row['email']) ?>'                      
                    ); return false;"
                    class="w-10 h-10 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center hover:bg-blue-200 transition">
                    <i class="fa-solid fa-pen"></i>
                  </a>

                  <a href="delete_user.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this user?')"
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
<div id="userModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">

  <div class="bg-white w-[900px] p-6 rounded-2xl shadow-lg">

    <h2 id="modalTitle" class="text-xl font-bold mb-4">Add User</h2>

    <form id="userForm" method="POST">

      <input type="hidden" name="id" id="user_id">

      <div>
        <label for="username" class="block mb-2 text-gray-700 font-medium">
          Username
        </label>
        <div class="relative">
          <span class="absolute left-4 top-3 text-gray-400">
            <i class="fa-solid fa-user"></i>
          </span>

          <input type="text" name="username" id="username" placeholder="Enter Username"
            class="w-full border border-gray-300 rounded-xl py-3 pl-12 pr-4 focus:outline-none focus:ring-2 focus:ring-[#20496b] mb-5">
        </div>
      </div>

      <div>
        <label for="fullname" class="block mb-2 text-gray-700 font-medium">
          Fullname
        </label>
        <div class="relative">
          <span class="absolute left-4 top-3 text-gray-400">
            <i class="fa-solid fa-address-card"></i>
          </span>

          <input type="text" name="fullname" id="fullname" placeholder="Enter Fullname"
            class="w-full border border-gray-300 rounded-xl py-3 pl-12 pr-4 focus:outline-none focus:ring-2 focus:ring-[#20496b] mb-5">
        </div>
      </div>

      <div>
        <label for="password" class="block mb-2 text-gray-700 font-medium">
          Password
        </label>
        <div class="relative">
          <span class="absolute left-4 top-3 text-gray-400">
            <i class="fa-solid fa-lock"></i>
          </span>

          <input type="text" name="password" id="password" placeholder="Enter Password" id="password"
            class="w-full border border-gray-300 rounded-xl py-3 pl-12 pr-4 focus:outline-none focus:ring-2 focus:ring-[#20496b] mb-5">

          <button type="button" onclick="togglePassword()"
            class="absolute right-4 top-3 text-gray-500 hover:text-gray-700">
            <i id="eyeIcon" class="fa-solid fa-eye"></i>
          </button>
        </div>
      </div>

      <div>
        <label for="phone_number" class="block mb-2 text-gray-700 font-medium">
          Phone Number
        </label>
        <div class="relative">
          <span class="absolute left-4 top-3 text-gray-400">
            <i class="fa-solid fa-phone"></i>
          </span>

          <input type="text" name="phone_number" id="phone_number" placeholder="Enter Phone Number"
            class="w-full border border-gray-300 rounded-xl py-3 pl-12 pr-4 focus:outline-none focus:ring-2 focus:ring-[#20496b] mb-5">
        </div>
      </div>

      <div>
        <label for="email" class="block mb-2 text-gray-700 font-medium">
          Email
        </label>
        <div class="relative">
          <span class="absolute left-4 top-3 text-gray-400">
            <i class="fa-solid fa-envelope"></i>
          </span>

          <input type="text" name="email" id="email" placeholder="Enter Email"
            class="w-full border border-gray-300 rounded-xl py-3 pl-12 pr-4 focus:outline-none focus:ring-2 focus:ring-[#20496b] mb-5">
        </div>
      </div>

      <div class="flex justify-end gap-2">

        <button type="button" onclick="closeUserModal()" class="px-4 py-2 bg-red-500 text-white rounded">
          Cancel
        </button>

        <button type="submit" class="px-4 py-2 bg-[#20496B] text-white rounded">
          Save
        </button>

      </div>

    </form>

  </div>
</div>

<script>
  function togglePassword() {
    const input = document.getElementById("password");
    const icon = document.getElementById("eyeIcon");

    if (input.type === "password") {
      input.type = "text";
      icon.classList.remove("fa-eye");
      icon.classList.add("fa-eye-slash")
    } else {
      input.type = "password";
      icon.classList.remove("fa-eye-slash")
      icon.classList.add("fa-eye");
    }
  }
</script>

<?php
$content = ob_get_clean();

include_once __DIR__ . "/../../layout/admin-layout.php";
?>