<?php
// Database connection
$host = "sql206.infinityfree.com";
$username = "if0_37717931";
$password = "cKVgha5gGdri";
$dbname = "if0_37717931_farmeasydb";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gmail = $_POST['gmail'];
    $pass = $_POST['pass'];

    $sql = "SELECT * FROM users WHERE gmail = '$gmail'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($pass, $user['pass'])) {
            session_start();
            
            $_SESSION['user'] = $user['name'];

            header("Location: index.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No account found with that email.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <h1>Login</h1>
    <form method="POST" action="">
        <label for="gmail">Email:</label>
        <input type="email" id="gmail" name="gmail" required><br><br>
        <label for="pass">Password:</label>
        <input type="password" id="pass" name="pass" required><br><br>
        <button type="submit">Login</button>
        <p>New user Register here</p>
        <button><a href="register.php">Register</a></button>
    </form>
</body>
</html>
