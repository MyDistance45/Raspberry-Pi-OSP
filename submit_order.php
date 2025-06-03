<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = 'localhost';
$db = 'order_track';
$user = 'root';
$pass = 'root';

// Connect to database
$conn = new mysqli("localhost", "root", "root", "order_track_db");


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get submitted data
$name = $_POST['name'] ?? null;
$email = $_POST['email'] ?? null;

// Validate inputs
if (!$email) {
    die("Email is required.");
}

// Generate order ID (random 8-char uppercase string)
$order_id = strtoupper(substr(md5(uniqid()), 0, 8));

// Insert into database
$stmt = $conn->prepare("INSERT INTO orders (order_id, customer_name, email, status) VALUES (?, ?, ?, 'waiting')");
$stmt->bind_param("sss", $order_id, $name, $email);

if ($stmt->execute()) {
    echo "✅ Order successfully submitted!<br>";
    echo "🆔 Your Order ID: <strong>#" . $order_id . "</strong>";
} else {
    echo "❌ Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
