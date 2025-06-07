<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order Track Application</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Your base and layout CSS -->
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
<h1>Welcome to the Order Track Website</h1>
<p>Track and manage your orders effortlessly through our system:</p>
<ul>
  <li>📧 <strong>Confirm your order</strong> — Enter your email to receive your tracking ID</li>
  <li>🔍 <strong>Track an existing order</strong> — Stay updated on your order status anytime</li>
  <li>🔐 <strong>Admin login</strong> — Authorized personnel can manage and update order records</li>
</ul>


</body>
</html>


