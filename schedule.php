<?php
include 'db.php';

// Fetch shifts from the database
$sql = "SELECT id, userId, date, time, location FROM shifts";
$result = $conn->query($sql);

$appointments = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $appointments[] = [
            'id' => $row['id'],
            'title' => "User " . $row['userId'], // Customize as needed
            'start' => $row['date'] . 'T' . $row['time'],
            'location' => $row['location']
        ];
    }
} else {
    die("Error fetching shifts: " . $conn->error);
}

$conn->close();

// Debugging: Output JSON data for verification
// echo json_encode($appointments, JSON_PRETTY_PRINT); exit();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule</title>

    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FullCalendar -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@5.11.3/main.min.js"></script>
</head>
<body class="bg-gray-100 p-6">
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

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Shift Schedule</h2>
        <div id="calendar"></div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const profileBtn = document.getElementById("profile-btn");
        const dropdown = document.getElementById("dropdown");

        profileBtn.addEventListener("click", function (event) {
            event.stopPropagation(); // Prevent closing immediately
            dropdown.classList.toggle("hidden");
        });

        // Close dropdown if clicked outside
        document.addEventListener("click", function (event) {
            if (!dropdown.contains(event.target) && !profileBtn.contains(event.target)) {
                dropdown.classList.add("hidden");
            }
        });
    });
</script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var appointments = <?php echo json_encode($appointments); ?>;

            console.log("Fetched Appointments:", appointments); // Debugging log

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: appointments.map(event => ({
                    id: event.id,
                    title: event.title,
                    start: event.start,
                    extendedProps: {
                        location: event.location
                    }
                })),
                eventClick: function(info) {
                    alert(`User: ${info.event.title}\nDate & Time: ${info.event.start.toLocaleString()}\nLocation: ${info.event.extendedProps.location}`);
                }
            });

            calendar.render();
        });
    </script>

</body>
</html>
