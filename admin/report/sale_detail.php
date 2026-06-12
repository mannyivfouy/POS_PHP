<?php
include_once __DIR__ . "/../../config/db.php";

$id = $_GET['id'];

$data = [];

$sale = mysqli_query($conn, "SELECT * FROM sales WHERE id = $id");
$data['sale'] = mysqli_fetch_assoc($sale);

$items = mysqli_query($conn, "
    SELECT sd.*, p.name
    FROM sale_items sd
    JOIN products p ON p.id = sd.product_id
    WHERE sd.sale_id = $id
");

$data['items'] = [];

while ($row = mysqli_fetch_assoc($items)) {
  $data['items'][] = $row;
}

echo json_encode($data);
?>