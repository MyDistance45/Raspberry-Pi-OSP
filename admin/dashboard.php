<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

$host = "localhost";
$user = "root";
$pass = "root";
$db   = "ordertrack";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT order_id, email, customer_name, status, created_at, updated_at FROM orders ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../style.css">
  <link rel="stylesheet" href="../layout.css">
  <h1>📊 Admin Dashboard</h1>
<p class="text-muted">Welcome, <strong><?= htmlspecialchars($_SESSION['admin_username']) ?></strong> 👋</p>

</head>
<body>

<?php include '../sidebar.php'; ?>


  <div class="content">
    <h1>📊 Order Dashboard</h1>
    
    <div class="table-responsive mt-4">
      <table class="table table-bordered table-striped align-middle bg-white">
        <thead class="table-primary text-center">
          <tr>
            <th>Order ID</th>
            <th>Email</th>
            <th>Customer</th>
            <th>Status</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Update Status</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <form method="POST" action="update_status.php" class="d-flex align-items-center">
              <td><?= htmlspecialchars($row['order_id']) ?></td>
              <td><?= htmlspecialchars($row['email']) ?></td>
              <td><?= htmlspecialchars($row['customer_name']) ?></td>
              <td><span class="badge bg-info text-dark"><?= htmlspecialchars($row['status']) ?></span></td>
              <td><?= htmlspecialchars($row['created_at']) ?></td>
              <td><?= htmlspecialchars($row['updated_at']) ?></td>
              <td class="d-flex">
                <input type="hidden" name="order_id" value="<?= $row['order_id'] ?>">
                <select name="new_status" class="form-select me-2" required>
                  <option value="waiting">waiting</option>
                  <option value="processing">processing</option>
                  <option value="shipped">shipped</option>
                  <option value="completed">completed</option>
                </select>
                <button type="submit" class="btn btn-success btn-sm">Update</button>
              </td>
            </form>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>

</body>
</html>
<?php $conn->close(); ?>


