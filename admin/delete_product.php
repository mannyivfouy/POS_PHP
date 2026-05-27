<?php
include_once __DIR__ . "/../config/db.php";

if (!isset($_GET['id'])) {
    die("No ID received");
}

$id = (int) $_GET['id'];

// DEBUG: check value
echo $id; exit;

$query = "DELETE FROM products WHERE id = $id";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("SQL ERROR: " . mysqli_error($conn));
}

header("Location: products.php");
exit;