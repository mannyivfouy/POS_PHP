<?php
include_once __DIR__ . "/../../config/db.php";

$id    = $_POST['id'];
$name  = $_POST['name'];
$price = $_POST['price'];
$qty   = $_POST['qty'];

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
    if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);

    // Delete old image
    $old = mysqli_query($conn, "SELECT image FROM products WHERE id=" . intval($id));
    $old_row = mysqli_fetch_assoc($old);
    if ($old_row['image'] && file_exists($upload_dir . $old_row['image'])) {
        unlink($upload_dir . $old_row['image']);
    }

    $image_name = uniqid('product_', true) . '.' . $ext;
    move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $image_name);

    $stmt = mysqli_prepare($conn, "UPDATE products SET name=?, price=?, qty=?, image=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "sdisi", $name, $price, $qty, $image_name, $id);
} else {
    // No new image uploaded — keep existing
    $stmt = mysqli_prepare($conn, "UPDATE products SET name=?, price=?, qty=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "sdii", $name, $price, $qty, $id);
}

mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

header("Location: products.php");
exit;