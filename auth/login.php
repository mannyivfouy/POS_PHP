<?php
session_start();
include_once __DIR__ . "/../config/db.php";

$error = "";

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $query = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);

    if ($password == $user['password']) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['username'] = $user['username'];

      header("Location: ../admin/dashboard.php");
      exit();
    } else {
      $error = "Wrong Password";
    }
  } else {
    $error = "User Not Found";
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>

<body class="bg-gray-100 flex justify-center items-center min-h-screen">
  <div class="w-full max-w-6xl bg-white rounded-3xl shadow-2xl overflow-hidden">
    <div class="flex flex-col md:flex-row min-h-[700px]">
      <!-- Left Panel -->
      <div class="md:w-1/3 bg-[#20496b] flex items-center justify-center p-10">
        <div class="text-center text-white">
          <img src="https://cdn-icons-png.flaticon.com/512/3081/3081559.png" alt="POS" class="w-56 mx-auto mb-8">

          <h1 class="text-4xl font-bold mb-4">
            POS SYSTEM
          </h1>

          <p class="text-lg text-gray-200 leading-relaxed">
            Manage products, sales, and inventory
            in one modern dashboard system.
          </p>
        </div>
      </div>

      <!-- Right panel -->
      <div class="md:w-2/3 flex items-center justify-center p-8 md:p-14">
        <div class="w-full mx-w-lg">
          <div class="mb-10">
            <h2 class="text-5xl font-bold text-[#20496b] mb-3">
              Sign In
            </h2>

            <p class="text-gray-500 text-lg">
              Login to continue your session
            </p>
          </div>

          <?php if (!empty($error)) { ?>
            <div class="bg-red-100 border border-red-300 text-red-600 px-4 py-4 rounded-xl mb-6">
              <?php echo $error; ?>
            </div>
          <?php } ?>

          <form action="" method="POST">
            <div>
              <label for="username" class="block mb-2 text-gray-700 font-medium">
                Username
              </label>
              <div class="relative">
                <span class="absolute left-4 top-3 text-gray-400">
                  <i class="fa-solid fa-user"></i>
                </span>

                <input type="text" name="username" placeholder="Enter Username"
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

                <input type="text" name="password" placeholder="Enter Password" id="password"
                  class="w-full border border-gray-300 rounded-xl py-3 pl-12 pr-4 focus:outline-none focus:ring-2 focus:ring-[#20496b] mb-12">

                <button type="button" onclick="togglePassword()"
                  class="absolute right-4 top-3 text-gray-500 hover:text-gray-700">
                  <i id="eyeIcon" class="fa-solid fa-eye"></i>
                </button>
              </div>
            </div>

            <button type="submit" name="login"
              class="w-full bg-[#20496B] hover:bg-[#17364f] text-white py-3 rounded-xl font-semibold transition duration-300">
              Login
            </button>
          </form>
        </div>
      </div>
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
</body>

</html>