<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$host = "sql206.infinityfree.com";
$username = "if0_37717931";
$password = "cKVgha5gGdri";
$dbname = "if0_37717931_farmeasydb";
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user'];  

if (isset($_GET['cancel_order'])) {
    $order_id = $_GET['cancel_order'];
    $conn->query("UPDATE orders SET status='canceled' WHERE id = $order_id AND user_id = $user_id");
    header("Location: order.php");
    exit();
}

$sql = "SELECT o.id, p.name AS product_name, o.quantity, o.total_price, o.status
        FROM orders o
        JOIN products p ON o.product_id = p.id
        WHERE o.user_id = $user_id";
$orders = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Your Orders</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <h1>Your Orders</h1>
    <a href="logout.php">Logout</a>
    
    <h2>Order List</h2>
    <?php if ($orders->num_rows > 0): ?>
        <table>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php while ($row = $orders->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['product_name']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td>$<?php echo $row['total_price']; ?></td>
                    <td><?php echo ucfirst($row['status']); ?></td>
                    <td>
                        <?php if ($row['status'] == 'active'): ?>
                            <a href="order.php?cancel_order=<?php echo $row['id']; ?>">Cancel Order</a>
                        <?php else: ?>
                            <span>Order Canceled</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>You have no orders yet.</p>
    <?php endif; ?>
</body>
</html>
