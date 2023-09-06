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

// Get the current day of the week
$today = date("l");

// Check if today is Friday, Saturday, or Sunday
if ($today == "Friday" || $today == "Saturday" || $today == "Sunday") {
  $status = "Closed - The Observatory is only open on clear nights Monday - Thursday";
} else {
  // Retrieve the status from the "status" column in the database
  $sql = "SELECT status FROM observatory_status ORDER BY id DESC LIMIT 1";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $statusFromDB = $row["status"];
  } else {
    $statusFromDB = "No status available";
  }

  // Retrieve the custom message from the "customMessage" column in the database
  $sql = "SELECT customMessage FROM observatory_status ORDER BY id DESC LIMIT 1";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $customMessage = $row["customMessage"];
  } else {
    $customMessage = "No custom message available";
  }

  // Check if the status is "CM" and set it to the custom message if it is
  if ($statusFromDB == "CM") {
    $status = $customMessage;
  } else {
    // Handle other status conditions here
    if ($statusFromDB == "open1") {
      $status = "The Observatory will be open tonight from 8pm to 10pm\n Come observe with us - See directions below";
    } elseif ($statusFromDB == "closed") {
      $status = "The Observatory will be CLOSED tonight";
    } elseif ($statusFromDB == "open2") {
      $status = "The Observatory will be open tonight from 7pm to 9pm\n Come observe with us - See directions below";
    } elseif ($statusFromDB == "not-yet-made") {
      $status = "A decision has not yet been made for tonight \n See below resources";
    }
  }
}

echo "Observatory Status: " . $status;

// Close database connection
mysqli_close($conn);
?>
