<?php
// Connect to database
$servername = "localhost";
$username = "tcnjobse_tech";
$password = "TcnjObserveStatus";
$dbname = "tcnjobse_status";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get status from form data
$status = $_POST['status'];

// Update status in database
$sql = "UPDATE observatory_status SET status = '$status' WHERE id = 1";
if (mysqli_query($conn, $sql)) {
  echo "Status updated successfully";
} else {
  echo "Error updating status: " . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);
?>