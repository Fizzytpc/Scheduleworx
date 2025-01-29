<?php
include 'db.php';

// Fetch shifts from the database
$sql = "SELECT id, userId, date, time, location FROM shifts";
$result = $conn->query($sql);

$appointments = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $appointments[] = [
            'id' => $row['id'],
            'title' => "User " . $row['userId'], // You can modify this to display meaningful text
            'start' => $row['date'] . 'T' . $row['time'],
            'location' => $row['location']
        ];
    }
} else {
    echo "No results found.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule</title>
    <link href='https://fullcalendar.io/releases/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    <script src='https://fullcalendar.io/releases/fullcalendar/3.10.2/lib/jquery.min.js'></script>
    <script src='https://fullcalendar.io/releases/fullcalendar/3.10.2/lib/moment.min.js'></script>
    <script src='https://fullcalendar.io/releases/fullcalendar/3.10.2/fullcalendar.min.js'></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
        }
        #calendar {
            max-width: 900px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

<h2>Shift Schedule</h2>
<div id='calendar'></div>

<script>
    $(document).ready(function() {
        var appointments = <?php echo json_encode($appointments); ?>;

        $('#calendar').fullCalendar({
            events: appointments,
            eventClick: function(event) {
                alert('User: ' + event.title + '\nDate & Time: ' + event.start + '\nLocation: ' + event.location);
            }
        });
    });
</script>

</body>
</html>
