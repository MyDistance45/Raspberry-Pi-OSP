<!DOCTYPE html>
<html>
<head>
    <title>Track Your Order</title>
</head>
<body>
    <h1>Order Status Tracker</h1>
    <form action="check_status.php" method="POST">
        <label for="order_id">Enter Your Order ID:</label>
        <input type="text" name="order_id" id="order_id" required>
        <button type="submit">Check Status</button>
    </form>
</body>
</html>
