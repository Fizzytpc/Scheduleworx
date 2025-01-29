<?php
include 'db.php'; // Include the database connection

header('Content-Type: application/json');

$sql = "SELECT date, time, location FROM shifts ORDER BY date ASC";
$result = $conn->query($sql);

$shifts = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $shifts[] = $row;
    }
}
echo json_encode($shifts);

$conn->close();
?>
