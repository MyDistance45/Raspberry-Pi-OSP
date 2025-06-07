<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$base = (basename(__DIR__) === 'admin') ? '../' : '';
?>
<div class="sidebar">
<div class="d-flex justify-content-center align-items-center mb-4" style="height: 120px;">
  <img src="<?= $base ?>assets/ordertracklogo.png"
       alt="OrderTrack Logo"
       style="height: 100px; width: auto; filter: brightness(0) invert(1);">
</div>

  <hr>
  <a href="<?= $base ?>index.php">🏠 Home</a>
  <a href="<?= $base ?>order.php">📝 Submit Order</a>
  <a href="<?= $base ?>track.php">🔍 Track Order</a>

  <?php if (!empty($_SESSION['admin_logged_in'])): ?>
    <a href="<?= $base ?>admin/dashboard.php">📊 Admin Dashboard</a>
    <a href="<?= $base ?>admin/logout.php">🚪 Logout</a>
  <?php else: ?>
    <a href="<?= $base ?>admin/login.php">🔐 Admin Login</a>
  <?php endif; ?>
</div>
