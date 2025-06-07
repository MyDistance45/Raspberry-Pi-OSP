<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Submit Order</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap + Your CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="layout.css">
</head>
<body>

<?php include 'sidebar.php'; ?>

    <div class="content">
    <h1>Order Status Tracker</h1>
    <form action="check_status.php" method="POST">
        <label for="order_id">Enter Your Order ID:</label>
        <input type="text" name="order_id" id="order_id" required>
        <button type="submit">Check Status</button>
    </form>
</div>
</body>
</html>
