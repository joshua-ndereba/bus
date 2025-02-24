<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bus_ticketing";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get form data
$busId = $_POST['busId'];
$passengers = []; // Parse passenger data from the form
$totalPrice = 0; // Calculate total price

// Save booking to the database
$sql = "INSERT INTO bookings (bus_id, total_price) VALUES ($busId, $totalPrice)";
if ($conn->query($sql) === TRUE) {
  $bookingId = $conn->insert_id;

  // Save passengers
  foreach ($passengers as $passenger) {
    $seatNumber = $passenger['seat'];
    $name = $passenger['name'];
    $age = $passenger['age'];

    $sql = "INSERT INTO passengers (booking_id, seat_number, name, age) VALUES ($bookingId, $seatNumber, '$name', $age)";
    $conn->query($sql);
  }

  // Redirect to confirmation page
  header("Location: confirmation.php?bookingId=$bookingId");
  exit();
} else {
  die("Error saving booking: " . $conn->error);
}

$conn->close();
?>