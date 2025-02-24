<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bus booking";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get search parameters from URL
$from = $_GET['from'];
$to = $_GET['to'];
$date = $_GET['date'];

// Fetch buses from the database
$sql = "SELECT * FROM buses WHERE from_location = '$from' AND to_location = '$to'";
$result = $conn->query($sql);

$buses = [];
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $buses[] = $row;
  }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search Buses</title>
  <link rel="stylesheet" href="../styles/style.css">
  <link rel="stylesheet" href="../styles/search.css">
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

  <section class="search-filters">
    <div class="filters-container">
      <h2>Filter Results</h2>
      <div class="filter-group">
        <label>Price Range:</label>
        <select id="priceFilter">
          <option value="all">All</option>
          <option value="0-500">₹0 - ₹500</option>
          <option value="500-1000">₹500 - ₹1000</option>
          <option value="1000-2000">₹1000 - ₹2000</option>
        </select>
      </div>
      <div class="filter-group">
        <label>Departure Time:</label>
        <select id="timeFilter">
          <option value="all">All</option>
          <option value="morning">Morning (6 AM - 12 PM)</option>
          <option value="afternoon">Afternoon (12 PM - 6 PM)</option>
          <option value="night">Night (6 PM - 12 AM)</option>
        </select>
      </div>
    </div>
  </section>

  <section class="bus-listings">
    <div class="bus-list-container" id="busList">
      <?php foreach ($buses as $bus): ?>
        <div class="bus-card">
          <div class="bus-info">
            <h3><?php echo $bus['name']; ?></h3>
            <p><i class="fas fa-clock"></i> Departure: <?php echo $bus['departure_time']; ?></p>
            <p><i class="fas fa-map-marker-alt"></i> <?php echo $bus['from_location']; ?> to <?php echo $bus['to_location']; ?></p>
            <p><i class="fas fa-chair"></i> Seats Available: <?php echo $bus['total_seats']; ?></p>
          </div>
          <div class="bus-price">
            <div class="price">₹<?php echo $bus['price']; ?></div>
            <button onclick="bookBus(<?php echo $bus['id']; ?>)">Book Now</button>
          </div>
        </div>
      <?php endforeach; ?>
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
  <script src="../scripts/search.js"></script>
</body>
</html>