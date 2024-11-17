<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];


$host = "sql206.infinityfree.com";
$username = "if0_37717931";
$password = "cKVgha5gGdri";
$dbname = "if0_37717931_farmeasydb";

    $conn = new mysqli($host, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE orders SET status='$status' WHERE id='$order_id'";
    if ($conn->query($sql) === TRUE) {
        header('Location: admin_panel.php');
    } else {
        echo "Error updating status: " . $conn->error;
    }
}
?>
