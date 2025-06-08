<?php
session_start();
$host = "localhost";
$user = "root";
$pass = "root";
$db   = "order_track_db";

$conn = new mysqli($host, $user, $pass, $db);
$errorMessage = '';

if ($conn->connect_error) {
    $errorMessage = "Connection failed: " . $conn->connect_error;
} else {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $username = $_POST["username"] ?? '';
        $password = $_POST["password"] ?? '';

        $stmt = $conn->prepare("SELECT password FROM admin WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($password === $row["password"]) {
                $_SESSION["admin_logged_in"] = true;
                $_SESSION["admin_username"] = $username;
                header("Location: dashboard.php");
                exit;
            } else {
                $errorMessage = "Incorrect password.";
            }
        } else {
            $errorMessage = "Admin not found.";
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
  <title>Admin Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../style.css">
  <link rel="stylesheet" href="../layout.css">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">

  <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
    <h3 class="mb-3 text-center">🔐 Admin Login</h3>

    <?php if ($errorMessage): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($errorMessage) ?></div>
    <?php endif; ?>

    <form method="POST" action="login.php">
      <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
  </div>

</body>
</html>



