<?php
session_start();
$host = "sql206.infinityfree.com";
$username = "if0_37717931";
$password = "cKVgha5gGdri";
$dbname = "if0_37717931_farmeasydb";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT p.name, p.price, p.discount_price, p.image, c.quantity 
        FROM cart c 
        JOIN products p ON c.product_id = p.id 
        WHERE c.user_id = '$user_id'";
$result = $conn->query($sql);

$total_amount = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cart</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <h1>Your Cart</h1>
    <div class="cart-items">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="cart-item">
                    <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" style="width:100px; height:auto;">
                    <h3><?php echo $row['name']; ?></h3>
                    <p>Price: $<?php echo $row['price']; ?></p>
                    <p>Quantity: <?php echo $row['quantity']; ?></p>
                    <p>Subtotal: $<?php echo $subtotal = $row['price'] * $row['quantity']; ?></p>
                    <?php $total_amount += $subtotal; ?>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Your cart is empty!</p>
        <?php endif; ?>
    </div>
    <h3>Total Amount: $<?php echo $total_amount; ?></h3>

    <?php if ($total_amount > 0): ?>
        <form method="POST" action="generate_bill.php">
            <input type="hidden" name="total_amount" value="<?php echo $total_amount; ?>">
            <button type="submit">Pay Now</button>
        </form>
    <?php endif; ?>
</body>
</html>
