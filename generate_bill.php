<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $total_amount = $_POST['total_amount'];
    $user_id = $_SESSION['user_id']; // Assume user_id is stored in the session

    $bill_id = rand(1000, 9999); 
    $date = date("Y-m-d H:i:s");

    echo "<h1>FarmEasy Bill</h1>";
    echo "<p>Bill ID: $bill_id</p>";
    echo "<p>Date: $date</p>";
    echo "<p>User ID: $user_id</p>";
    echo "<h3>Total Amount: $$total_amount</h3>";

    $host = "localhost"; //remaining part
    $username = "root";
    $password = "";
    $dbname = "farmeasy";

    $conn = new mysqli($host, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM cart WHERE user_id = '$user_id'";
    if ($conn->query($sql) === TRUE) {
        echo "<p>Your payment was successful. The cart has been cleared!</p>";
    } else {
        echo "<p>Error clearing cart: " . $conn->error . "</p>";
    }
}
?>
