<?php
include_once __DIR__ . "/../config/db.php";

$id = (int) $_GET['id'];

mysqli_query($conn, "DELETE FROM products WHERE id = $id");

header("Location: products.php");
exit;