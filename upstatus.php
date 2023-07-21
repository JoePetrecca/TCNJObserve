<?php
// Connect to database
$servername = "localhost";
$username = "USERNAME";
$password = "PASSWORD";
$dbname = "DBNAME";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get the current day of the week
$today = date("l");

// Check if today is Friday, Saturday, or Sunday
if ($today == "Friday" || $today == "Saturday" || $today == "Sunday") {
  $status = "Closed - The Observatory is only open on clear nights Monday - Thursday";
} else {
  $sql = "SELECT status FROM observatory_status ORDER BY id DESC LIMIT 1";
  $result = mysqli_query($conn, $sql);
  
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $status = $row["status"];

    if ($status == "open") {
      $status = "The Observatory will be open tonight from 8pm to 10pm\n Come observe with us - See directions below";
    } elseif ($status == "closed") {
      $status = "The Observatory will be CLOSED for the Summer";
    } else {
      $status = "A decision has not yet been made for tonight \n See below resources";
    }
  } else {
    $status = "'Observatory status is unknown";
  }
}

echo "Observatory Status: " . $status;

// Close database connection
mysqli_close($conn);
?>
