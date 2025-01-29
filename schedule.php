<?php
  include 'db.php';

  $sql = "SELECT id, date, time, FROM appointments";
$result = $conn->query($sql);

$appointments = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $appointments[] = $row;
    }
} else {
    echo "0 results";
}
$conn->close(); 
?>

<!DOCTYPE html>
<html>
<head>
    <link href='https://fullcalendar.io/releases/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    <script src='https://fullcalendar.io/releases/fullcalendar/3.10.2/lib/jquery.min.js'></script>
    <script src='https://fullcalendar.io/releases/fullcalendar/3.10.2/lib/moment.min.js'></script>
    <script src='https://fullcalendar.io/releases/fullcalendar/3.10.2/fullcalendar.min.js'></script>
    <style>
        /* Add your custom styles here */
    </style>
</head>
<body>
    <div id='calendar'></div>

    <script>
        $(document).ready(function() {
            var appointments = <?php echo json_encode($appointments); ?>;
            $('#calendar').fullCalendar({
                events: appointments,
                eventClick: function(event) {
                    alert('Title: ' + event.title + '\nDescription: ' + event.description);
                }
            });
        });
    </script>
</body>
</html>