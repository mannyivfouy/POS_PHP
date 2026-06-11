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

foreach ($cart as $item) {

    $id = (int) $item['id'];
    $qty = (int) $item['qty'];

    // IMPORTANT: prevent negative stock
    $query = "UPDATE products 
              SET qty = qty - $qty 
              WHERE id = $id AND qty >= $qty";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo json_encode([
            "success" => false,
            "message" => "SQL error: " . mysqli_error($conn)
        ]);
        exit;
    }
}

echo json_encode([
    "success" => true
]);