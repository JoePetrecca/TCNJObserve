<?php
// Connect to database
$servername = "localhost";
$username = "xxxxxxxxxxxxxxxxxxxxx";
$password = "xxxxxxxxxxxxxxxxxxxxxxx";
$dbname = "xxxxxxxxxxxxxxxxxx";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get status from form data
$status = $_POST['status'];
$customMessage = $_POST['custom_message'];

// Update status in the database
$statusSql = "UPDATE observatory_status SET status = '$status' WHERE id = 1";
$customMessageSql = "UPDATE observatory_status SET customMessage = '$customMessage' WHERE id = 1";

if (mysqli_query($conn, $statusSql) && mysqli_query($conn, $customMessageSql)) {
  echo "Status and Custom Message updated successfully";
} else {
  echo "Error updating status or custom message: " . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);
?>
