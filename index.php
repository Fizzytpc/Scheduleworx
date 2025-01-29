<?php include 'tailwind.html'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ScheduleWorx</title>
</head>
<body class="bg-purple-50 text-gray-800">
    <div class="bg-slate-200 text-black p-4 flex justify-between items-center">
        <!-- Header -->
        <div class="w-full bg-slate-200 flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">ScheduleWorx</h1>

            <!-- Profile Dropdown -->
            <div class="relative">
                <button id="profile-btn" class="w-10 h-10 rounded-full overflow-hidden shadow border-2 border-gray-300">
                    <img src="profile.jpg" alt="Profile" class="w-full h-full object-cover">
                </button>
                <div id="profile-menu" class="absolute right-0 mt-2 w-40 bg-white rounded shadow-lg hidden">
                    <a href="index.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Shifts</a>
                    <a href="availability.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Availability</a>
                    <a href="schedule.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Schedule</a>
                </div>
            </div>
    </div>
        </div>
    <div class="container mx-auto p-4">        <!-- Shifts Section -->
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
        const profileMenu = document.getElementById('profile-menu');

        profileBtn.addEventListener('click', () => {
            profileMenu.classList.toggle('hidden');
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
