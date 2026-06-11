<?php
include_once __DIR__ . "/../../config/db.php";

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['cart'])) {
    echo json_encode([
        "success" => false,
        "message" => "No cart data"
    ]);
    exit;
}

$cart = $data['cart'];

$total = 0;

// Create sale record first
mysqli_query($conn, "INSERT INTO sales (total) VALUES (0)");
$sale_id = mysqli_insert_id($conn);

foreach ($cart as $item) {

    $id = (int) $item['id'];
    $name = mysqli_real_escape_string($conn, $item['name']);
    $price = (float) $item['price'];
    $qty = (int) $item['qty'];

    $subtotal = $price * $qty;
    $total += $subtotal;

    // Save sale item
    mysqli_query($conn, "
        INSERT INTO sale_items
        (sale_id, product_id, product_name, price, qty, subtotal)
        VALUES
        ($sale_id, $id, '$name', $price, $qty, $subtotal)
    ");

    // Update stock
    $query = "
        UPDATE products
        SET qty = qty - $qty
        WHERE id = $id AND qty >= $qty
    ";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo json_encode([
            "success" => false,
            "message" => mysqli_error($conn)
        ]);
        exit;
    }
}

// Update sale total
mysqli_query($conn, "
    UPDATE sales
    SET total = $total
    WHERE id = $sale_id
");

echo json_encode([
    "success" => true,
    "sale_id" => $sale_id
]);