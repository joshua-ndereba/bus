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

// Get bus ID from URL
$busId = $_GET['busId'];

// Fetch bus details
$sql = "SELECT * FROM buses WHERE id = $busId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $bus = $result->fetch_assoc();
} else {
  die("Bus not found.");
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Bus</title>
  <link rel="stylesheet" href="../styles/style.css">
  <link rel="stylesheet" href="../styles/booking.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
  <header>
    <nav>
      <div class="logo">
        <img src="../assets/images/logo.png" alt="Bus Ticketing Logo">
      </div>
      <ul class="nav-links">
        <li><a href="../index.php">Home</a></li>
        <li><a href="search.php">Search Buses</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="#">Login</a></li>
      </ul>
    </nav>
  </header>

  <section class="booking-container">
    <div class="bus-details">
      <h2 id="busName"><?php echo $bus['name']; ?></h2>
      <p><i class="fas fa-clock"></i> Departure: <span id="departureTime"><?php echo $bus['departure_time']; ?></span></p>
      <p><i class="fas fa-map-marker-alt"></i> <span id="busRoute"><?php echo $bus['from_location']; ?> to <?php echo $bus['to_location']; ?></span></p>
    </div>

    <div class="seat-map">
      <h3>Select Seats</h3>
      <div class="seat-grid" id="seatGrid">
        <?php for ($i = 1; $i <= $bus['total_seats']; $i++): ?>
          <div class="seat"><?php echo $i; ?></div>
        <?php endfor; ?>
      </div>
    </div>

    <div class="passenger-form">
      <h3>Passenger Details</h3>
      <form id="passengerForm" method="POST" action="save_booking.php">
        <input type="hidden" name="busId" value="<?php echo $bus['id']; ?>">
        <!-- Passenger fields will be dynamically added here -->
      </form>
    </div>

    <div class="booking-summary">
      <h3>Booking Summary</h3>
      <div class="summary-details">
        <p>Selected Seats: <span id="selectedSeats">0</span></p>
        <p>Total Price: ₹<span id="totalPrice">0</span></p>
        <button type="submit" form="passengerForm">Book Now</button>
      </div>
    </div>
  </section>

  <footer>
    <div class="footer-content">
      <p>&copy; 2023 Bus Ticketing System. All rights reserved.</p>
      <div class="social-icons">
        <a href="#"><i class="fab fa-facebook"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
  </footer>

  <script src="../scripts/main.js"></script>
  <script src="../scripts/booking.js"></script>
</body>
</html>