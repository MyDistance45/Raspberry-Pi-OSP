<?php
$host = "localhost";
$user = "root";
$pass = "your_password_here"; // Replace with your MariaDB password
$db   = "order_track_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$order_id = $_POST['order_id'] ?? '';

if (!$order_id) {
    echo "Order ID is required.";
    exit;
}

$stmt = $conn->prepare("SELECT status FROM orders WHERE order_id = ?");
$stmt->bind_param("s", $order_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<h2>Your order status: " . htmlspecialchars($row['status']) . "</h2>";
} else {
    echo "<h2>Order not found.</h2>";
}

$stmt->close();
$conn->close();
?>
