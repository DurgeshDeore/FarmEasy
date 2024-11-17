<?php

$host = "sql206.infinityfree.com";
$username = "if0_37717931";
$password = "cKVgha5gGdri";
$dbname = "if0_37717931_farmeasydb";

$conn = new mysqli($host, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $gmail = $_POST['gmail'];
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT); 

    $sql = "INSERT INTO users (name, gmail, pass) VALUES ('$name', '$gmail', '$pass')";
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <h1>Register</h1>
    <form method="POST" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="gmail">Email:</label>
        <input type="email" id="gmail" name="gmail" required><br><br>
        <label for="pass">Password:</label>
        <input type="password" id="pass" name="pass" required><br><br>
        <button type="submit">Register</button>
        <p>Already Register ? login here
        <a href="login.php">Register</a></p>

    </form>
</body>
</html>
