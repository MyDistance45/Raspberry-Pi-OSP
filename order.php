<?php 
session_start(); 
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


<?php include 'sidebar.php'; ?>


  <div class="content">
  <h1>Submit Your Order</h1>
  <form action="submit_order.php" method="POST">
    <label for="email">Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label for="name">Name (optional):</label><br>
    <input type="text" name="name"><br><br>

    <input type="submit" value="Submit Order">
  </form>
</div>
</body>
</html>
