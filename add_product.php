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
    $price = $_POST['price'];
    $discount_price = $_POST['discount_price'];
    $description = $_POST['description'];

    $image = $_FILES['image']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        $sql = "INSERT INTO products (name, price, discount_price, description, image) 
                VALUES ('$name', '$price', '$discount_price', '$description', '$target_file')";
        if ($conn->query($sql) === TRUE) {
            header("Location: admin_panel.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading image.";
    }
}
?>