<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FarmEasy - Home</title>
    <link rel="stylesheet" href="style.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #4CAF50;
            padding: 10px 0;
            text-align: center;
        }
        header a {
            color: white;
            text-decoration: none;
            margin: 0 20px;
            font-size: 18px;
        }
        header a:hover {
            text-decoration: underline;
        }
        .content {
            padding: 20px;
            text-align: center;
        }
        .logout {
            color: red;
            text-decoration: none;
            font-size: 16px;
        }
        .logout:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <header>
        <a href="product.php">Products</a>
        <a href="cart.php">Cart</a>
        <a href="logout.php" class="logout">Logout</a>
    </header>

    <!-- Main Content -->
    <div class="content">
        <h1>Welcome</h1>

        <p>Hello, <?php echo $_SESSION['user']; ?>! Welcome back to FarmEasy.</p>
    </div>

</body>
</html>
