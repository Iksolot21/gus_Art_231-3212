<?php
include 'includes/db_connect.php';

if (isset($_GET['id'])) {
    $productId = (int)$_GET['id'];
    $stmt = $pdo->prepare('SELECT id, name, price FROM products WHERE id = ?');
    $stmt->execute([$productId]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($product);
}
?>