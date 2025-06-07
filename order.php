<?php 
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Submit Order</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="layout.css">
</head>
<body>


<div class="sidebar">
  <h4 class="text-center">📦 OrderTrack</h4>
  <hr>
  <a href="index.php">🏠 Home</a>
  <a href="order.php">📝 Submit Order</a>
  <a href="track.php">🔍 Track Order</a>

  <?php if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in']): ?>
    <a href="admin/dashboard.php">📊 Admin Dashboard</a>
    <a href="admin/logout.php">🚪 Logout</a>
  <?php else: ?>
    <a href="admin/login.php">🔐 Admin Login</a>
  <?php endif; ?>
</div>

  <div class="content">
  <h1>Submit Your Order</h1>
  <form action="submit_order.php" method="POST">
    <label for="email">Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label for="name">Name (optional):</label><br>
    <input type="text" name="name"><br><br>

    <input type="submit" value="Submit Order">
  </form>
</div>
</body>
</html>
