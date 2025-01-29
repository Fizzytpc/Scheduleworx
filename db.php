<?php
$servername = "vcict.nl.mysql"; // Replace with your server name
$username = "vcict_nlscheduleworx";        // Replace with your DB username
$password = "scheduleworx2234";            // Replace with your DB password
$dbname = "vcict_nlscheduleworx";  // Replace with your DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
