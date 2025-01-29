<?php include 'tailwind.html'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ScheduleWorx</title>
</head>
<body class="bg-purple-50 text-gray-800">
<header class="bg-slate-200 text-black p-4 flex justify-between items-center">
  <h1 class=" text-2xl font-bold">ScheduleWorx</h1>
  <div class="relative">
    <div class="flex items-center space-x-2 cursor-pointer" id="profileMenu">
      <div id="profile-btn" class="flex items-center space-x-2">
        <button class="w-10 h-10 rounded-full overflow-hidden shadow border-2 border-gray-300">
          <img src="profile.jpg" alt="Profile" class="w-full h-full object-cover">
        </button>
        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </div>
    </div>
    <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg hidden" id="dropdown">
      <a href="index.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Shifts</a>
      <a href="availability.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Beschikbaarheid</a>
      <a href="schedule.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Rooster</a>
    </div>
  </div>
</header>

<div class="container mx-auto p-4">
  <p class="text-lg">Goodmorning John! Your next shift:</p>
  <div id="next-shift" class="p-4 bg-white rounded shadow mb-4">
    <!-- Next shift details go here -->
  </div>

  <p class="text-lg">Upcoming:</p>
  <div id="upcoming-shifts" class="grid gap-4">
    <!-- Upcoming shifts go here -->
  </div>
</div>

<script>
  // Toggle profile menu
  const profileBtn = document.getElementById('profile-btn');
  const dropdownMenu = document.getElementById('dropdown');

  profileBtn.addEventListener('click', () => {
    dropdownMenu.classList.toggle('hidden');
  });

  // Fetch shifts from fetchdata.php
  fetch('fetchdata.php')
    .then(response => response.json())
    .then(data => {
      const nextShiftElement = document.getElementById('next-shift');
      const upcomingShiftsElement = document.getElementById('upcoming-shifts');

      if (data.length > 0) {
        // Populate the next shift
        const nextShift = data[0];
        nextShiftElement.innerHTML = `
          <div class="flex items-center space-x-4">
            <span class="text-xl font-semibold">${new Date(nextShift.date).toLocaleDateString()}</span>
            <span>${nextShift.time}</span>
            <span>${nextShift.location}</span>
          </div>
        `;

        // Populate the upcoming shifts
        for (let i = 1; i < data.length; i++) {
          const shift = data[i];
          upcomingShiftsElement.innerHTML += `
            <div class="p-4 bg-white rounded shadow">
              <div class="flex items-center space-x-4">
                <span class="text-xl font-semibold">${new Date(shift.date).toLocaleDateString()}</span>
                <span>${shift.time}</span>
                <span>${shift.location}</span>
              </div>
            </div>
          `;
        }
      } else {
        nextShiftElement.innerHTML = "<p>No shifts available</p>";
      }
    })
    .catch(error => {
      console.error('Error fetching data:', error);
    });
</script>
</body>
</html>
