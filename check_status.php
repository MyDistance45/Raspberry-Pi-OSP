<?php
$host = 'localhost';
$db   = 'order_track_db';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

$statusMessage = '';

if ($conn->connect_error) {
    $statusMessage = "<p class='text-danger'>Connection failed: " . $conn->connect_error . "</p>";
} else {
    $order_id = $_POST['order_id'] ?? '';

    if (!$order_id) {
        $statusMessage = "<p class='text-danger'>Order ID is required.</p>";
    } else {
        $stmt = $conn->prepare("SELECT status FROM orders WHERE order_id = ?");
        $stmt->bind_param("s", $order_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $statusMessage = "<h2>Your order status: <span class='text-success'>" . htmlspecialchars($row['status']) . "</span></h2>";
        } else {
            $statusMessage = "<h2 class='text-danger'>Order not found.</h2>";
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
  <title>Order Status</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="layout.css">
</head>
<body>

<?php session_start(); ?>
<?php include 'sidebar.php'; ?>


  <div class="content">
    <h1>🔎 Order Status</h1>
    <?= $statusMessage ?>
  </div>

</body>
</html>
