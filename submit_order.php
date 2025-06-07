<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = 'localhost';
$db   = 'order_track_db';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

$statusMessage = '';

if ($conn->connect_error) {
    $statusMessage = "<p class='text-danger'>Connection failed: " . $conn->connect_error . "</p>";
} else {
    $name = $_POST['name'] ?? null;
    $email = $_POST['email'] ?? null;

    if (!$email) {
        $statusMessage = "<p class='text-danger'>Email is required.</p>";
    } else {
        $order_id = strtoupper(substr(md5(uniqid()), 0, 8));
        $stmt = $conn->prepare("INSERT INTO orders (order_id, customer_name, email, status) VALUES (?, ?, ?, 'waiting')");
        $stmt->bind_param("sss", $order_id, $name, $email);

        if ($stmt->execute()) {
            $statusMessage = "<h2 class='text-success'>✅ Order successfully submitted!</h2>
                              <p>Your Order ID is: <strong>#$order_id</strong></p>
                              <p><a href='track.php?id=$order_id' class='btn btn-outline-primary mt-3'>🔍 Track Your Order</a></p>";
        } else {
            $statusMessage = "<p class='text-danger'>❌ Error: " . $stmt->error . "</p>";
        }

        $stmt->close();
    }

    $conn->close();
}
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
  <a href="/index.php">🏠 Home</a>
  <a href="/order.php">📝 Submit Order</a>
  <a href="/track.php">🔍 Track Order</a>

  <?php if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in']): ?>
    <a href="admin/dashboard.php">📊 Admin Dashboard</a>
    <a href="admin/logout.php">🚪 Logout</a>
  <?php else: ?>
    <a href="admin/login.php">🔐 Admin Login</a>
  <?php endif; ?>
</div>

  <div class="content">
    <h1>📤 Order Submission</h1>
    <?= $statusMessage ?>
  </div>

</body>
</html>



