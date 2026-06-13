<?php
include_once __DIR__ . "/../../config/db.php";

$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];
$qty = $_POST['qty'];

//   GET OLD QTY 
$old = mysqli_query($conn, "SELECT qty FROM products WHERE id=" . intval($id));
$old_row = mysqli_fetch_assoc($old);

$oldQty = $old_row['qty'];
$newQty = $qty;

$diff = $newQty - $oldQty;

//  IMAGE UPDATE
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

    // Delete old image
    $old_img = mysqli_query($conn, "SELECT image FROM products WHERE id=" . intval($id));
    $old_img_row = mysqli_fetch_assoc($old_img);

    if ($old_img_row['image'] && file_exists($upload_dir . $old_img_row['image'])) {
        unlink($upload_dir . $old_img_row['image']);
    }

    $image_name = uniqid('product_', true) . '.' . $ext;
    move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $image_name);

    $stmt = mysqli_prepare($conn, "UPDATE products SET name=?, price=?, qty=?, image=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "sdisi", $name, $price, $qty, $image_name, $id);

} else {
    $stmt = mysqli_prepare($conn, "UPDATE products SET name=?, price=?, qty=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "sdii", $name, $price, $qty, $id);
}

mysqli_stmt_execute($stmt);

//   EXPENSE (ONLY IF STOCK INCREASE)
if ($diff > 0) {
    $expense = $diff * $price;

    mysqli_query($conn, "
        INSERT INTO expenses (description, amount, created_at)
        VALUES ('Restock: $name (+$diff)', $expense, NOW())
    ");
}

mysqli_stmt_close($stmt);

header("Location: products.php");
exit;