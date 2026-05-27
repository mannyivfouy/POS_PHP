<div class="h-10 bg-[#20496b] border-b border-gray-200 flex items-center justify-between px-6 shadow-sm text-white">

  <div class="flex items-center gap-6 text-sm">

    <div class="flex items-center gap-2">
      <i class="fa-solid fa-location-dot text-blue-500"></i>
      <span>Phnom Penh, Cambodia</span>
    </div>

    <div class="flex items-center gap-2">
      <i class="fa-regular fa-clock text-green-500"></i>
      <span id="clock"></span>
    </div>

  </div>

  <div class="text-bold text-medium">
    <h1>
      <!-- Welcome Back <?= $_SESSION['username']; ?> -->
    </h1>    
  </div>
</div>

<script>
  function updateClock() {
    const now = new Date();

    document.getElementById("clock").innerHTML =
      now.toLocaleTimeString();
  }

  setInterval(updateClock, 1000);
  updateClock();
</script>