<?php
include_once __DIR__ . "/../config/db.php";

$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];
$qty = $_POST['qty'];

$query = "UPDATE products 
SET name='$name', price='$price', qty='$qty'
WHERE id=$id";

mysqli_query($conn, $query);

header("Location: products.php");