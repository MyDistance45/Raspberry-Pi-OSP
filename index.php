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

<?php include 'sidebar.php'; ?>


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


