<!DOCTYPE html>
<html>
<head>
  <title>Order Form</title>
</head>
<body>
  <h1>Submit Your Order</h1>
  <form action="submit_order.php" method="POST">
    <label for="email">Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label for="name">Name (optional):</label><br>
    <input type="text" name="name"><br><br>

    <input type="submit" value="Submit Order">
  </form>
</body>
</html>
