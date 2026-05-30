<?php
include_once __DIR__ . "/../../config/db.php";

$name = $_POST['name'];
$price = $_POST['price'];
$qty = $_POST['qty'];

$query = "INSERT INTO products (name, price, qty)
VALUES ('$name', '$price', '$qty')";

mysqli_query($conn, $query);

header("Location: products.php");