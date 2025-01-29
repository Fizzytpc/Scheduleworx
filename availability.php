<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Beschikbaarheid</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    async function fetchUserData() {
      try {
        const response = await fetch('fetch_user.php'); // PHP script to fetch user info
        const data = await response.json();

        if (data.error) {
          console.error("Error:", data.error);
          return;
        }

        // Display user info
        const user = data.user;
        if (user) {
          document.getElementById("user-name").innerText = `${user.firstName} ${user.lastName}`;
        }
      } catch (error) {
        console.error("Error fetching user data:", error);
      }
    }

    // Call fetchUserData when the page loads
    window.onload = fetchUserData;
  </script>
</head>
<body class="bg-purple-50 text-black font-sans">

<!-- Navbar -->
<header class="bg-slate-200 text-black p-4 flex justify-between items-center">
  <h1 class=" text-2xl font-bold">ScheduleWorx</h1>
  <div class="relative">
    <div class="flex items-center space-x-2 cursor-pointer" id="profileMenu">
    <button id="profile-btn" class="w-10 h-10 rounded-full overflow-hidden shadow border-2 border-gray-300">
                    <img src="profile.jpg" alt="Profile" class="w-full h-full object-cover">
                </button>
      <svg class=" w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
      </svg>
    </div>
    <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg hidden" id="dropdown">
      <a href="index.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Shifts</a>
      <a href="availability.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Beschikbaarheid</a>
      <a href="schedule.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Rooster</a>
    </div>
  </div>
</header>

<script>
  const profileMenu = document.getElementById('profileMenu');
  const dropdown = document.getElementById('dropdown');

  profileMenu.addEventListener('click', () => {
    dropdown.classList.toggle('hidden');
  });
</script>

<!-- Main Content -->
<div class="container mx-auto p-4">
  <h2 class="text-black text-2xl font-bold mb-6">Jouw Beschikbaarheid</h2>
  
  <!-- Availability Form -->
  <div class="bg-white p-6 rounded-lg shadow-lg">
    <h3 class="text-lg font-semibold mb-4">Voer jouw beschikbaarheid in:</h3>
    <form class="space-y-4" method="POST" action="submit_availability.php">
      <div>
        <label for="date" class="block font-semibold text-gray-700">Datum:</label>
        <input type="date" id="date" name="date" required class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-purple-300">
      </div>
      <div>
        <label for="time" class="block font-semibold text-gray-700">Tijd:</label>
        <input type="time" id="time" name="time" required class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-purple-300">
      </div>
      <button type="submit" class="bg-black text-white px-4 py-2 rounded-lg hover:bg-slate-700">Verstuur</button>
    </form>
  </div>
</div>

</body>
</html>
