<?php
session_start();

// Ensure admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

// DB connection
$host = "localhost";
$user = "root";
$pass = ""; // Your DB password
$db   = "order_track_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$order_id = $_POST['order_id'] ?? '';
$new_status = $_POST['new_status'] ?? '';

if ($order_id && $new_status) {
    $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE order_id = ?");
    $stmt->bind_param("ss", $new_status, $order_id);

    if ($stmt->execute()) {
        header("Location: dashboard.php"); // Redirect back after update
        exit;
    } else {
        echo "Failed to update status.";
    }

    $stmt->close();
} else {
    echo "Invalid request. Missing data.";
}

$conn->close();
?>
