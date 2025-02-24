<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $from = $_POST['from'];
  $to = $_POST['to'];
  $date = $_POST['date'];
  header("Location: pages/search.php?from=$from&to=$to&date=$date");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bus Ticketing System</title>
  <link rel="stylesheet" href="styles/style.css">
  <link rel="stylesheet" href="styles/homepage.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
  <header>
    <nav>
      <div class="logo">
        <img src="assets/images/logo.png" alt="Bus Ticketing Logo">
      </div>
      <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="pages/search.php">Search Buses</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="#">Login</a></li>
      </ul>
    </nav>
  </header>

  <section class="hero">
    <div class="hero-content">
      <h1>Book Your Bus Tickets Online</h1>
      <p>Travel to your favorite destinations with ease and comfort.</p>
      <form method="POST" action="index.php">
        <input type="text" name="from" placeholder="From" required>
        <input type="text" name="to" placeholder="To" required>
        <input type="date" name="date" placeholder="Date" required>
        <button type="submit">Search Buses <i class="fas fa-search"></i></button>
      </form>
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

  <script src="scripts/main.js"></script>
  <script src="scripts/homepage.js"></script>
</body>
</html>