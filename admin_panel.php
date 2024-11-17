<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
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

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $conn->query("DELETE FROM products WHERE id = $delete_id");
    header("Location: admin_panel.php");
    exit();
}

if (isset($_GET['block_user'])) {
    $user_id = $_GET['block_user'];
    $conn->query("UPDATE users SET status='blocked' WHERE id = $user_id");
    header("Location: admin_panel.php");
    exit();
} elseif (isset($_GET['unblock_user'])) {
    $user_id = $_GET['unblock_user'];
    $conn->query("UPDATE users SET status='active' WHERE id = $user_id");
    header("Location: admin_panel.php");
    exit();
}

// Fetch products and users
$products = $conn->query("SELECT * FROM products");
$users = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <h1>Welcome, Admin</h1>
    <a href="logout.php">Logout</a>

    <!-- Manage Products -->
    <h2>Manage Products</h2>
    <form method="POST" action="add_product.php" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Product Name" required>
        <input type="number" name="price" placeholder="Price" required>
        <input type="number" name="discount_price" placeholder="Discount Price">
        <textarea name="description" placeholder="Description" required></textarea>
        <input type="file" name="image" required>
        <button type="submit">Add Product</button>
    </form>

    <h3>Product List</h3>
    <?php while ($row = $products->fetch_assoc()): ?>
        <div>
            <p><?php echo $row['name']; ?> - $<?php echo $row['price']; ?></p>
            <a href="admin_panel.php?delete_id=<?php echo $row['id']; ?>">Delete</a>
        </div>
    <?php endwhile; ?>

    <!-- Manage Users -->
    <h2>Manage Users</h2>
    <h3>User List</h3>
    <?php while ($row = $users->fetch_assoc()): ?>
        <p>
            <?php echo $row['name']; ?> - <?php echo $row['gmail']; ?>
            <?php if ($row['status'] == 'active'): ?>
                <a href="admin_panel.php?block_user=<?php echo $row['id']; ?>">Block</a>
            <?php else: ?>
                <a href="admin_panel.php?unblock_user=<?php echo $row['id']; ?>">Unblock</a>
            <?php endif; ?>
        </p>
    <?php endwhile; ?>
</body>
</html>
