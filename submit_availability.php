<?php
// Include database connection file
include 'db.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $date = $_POST['date'];
    $time = $_POST['time'];
    $userId = 1; // Replace with dynamic user ID (if needed, fetch from session or login)

    // Validate form data
    if (empty($date) || empty($time)) {
        die("All fields are required.");
    }

    // Prepare the SQL query to insert data
    $stmt = $conn->prepare("INSERT INTO availability (userId, date, time) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $userId, $date, $time);

    // Execute the query
    if ($stmt->execute()) {
        // Redirect back to availability.php
        header("Location: availability.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If not a POST request, redirect to availability.php
    header("Location: availability.php");
    exit();
}
?>
