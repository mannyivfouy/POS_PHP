<?php
include_once __DIR__ . "/../../config/db.php";

$name = $_POST['name'];
$price = $_POST['price'];
$qty = $_POST['qty'];

$image_name = null;

if (!empty($_FILES['image']['name'])) {
    $allowed = ['jpg', 'jpeg', 'png', 'webp'];
    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed)) {
        die("Invalid file type.");
    }
    if ($_FILES['image']['size'] > 2 * 1024 * 1024) {
        die("File too large. Max 2MB.");
    }

    $upload_dir = __DIR__ . "/../../uploads/products/";
    if (!is_dir($upload_dir))
        mkdir($upload_dir, 0755, true);

    $image_name = uniqid('product_', true) . '.' . $ext;
    move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $image_name);
}

$stmt = mysqli_prepare($conn, "INSERT INTO products (name, price, qty, image) VALUES (?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "sdis", $name, $price, $qty, $image_name);
mysqli_stmt_execute($stmt);

// EXPENSE FOR NEW STOCK
$expense = $price * $qty;

mysqli_query($conn, "
    INSERT INTO expenses (description, amount, created_at)
    VALUES ('New Product Stock: $name', $expense, NOW())
");

mysqli_stmt_close($stmt);

header("Location: products.php");
exit;