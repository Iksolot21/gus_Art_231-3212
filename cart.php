<?php include 'includes/header.php'; ?>

<h2>Ваш список покупок</h2>

<?php
if (!empty($_SESSION['cart'])) {
    echo '<table class="products-table">';
    echo '<thead><tr><th>Название</th><th>Цена</th><th>Удалить</th></tr></thead>';
    echo '<tbody>';
    foreach ($_SESSION['cart'] as $product_id) {
        $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
        $stmt->execute([$product_id]);
        $product = $stmt->fetch();
        if ($product) {
            echo '<tr>';
            echo '<td>' . $product['name'] . '</td>';
            echo '<td>$' . $product['price'] . '</td>';
            echo '<td><button class="remove-from-cart" data-product-id="' . $product['id'] . '">Удалить</button></td>';
            echo '</tr>';
        }
    }
    echo '</tbody>';
    echo '</table>';
} else {
    echo '<p>Ваш список покупок пуст.</p>';
}
?>

<?php include 'includes/footer.php'; ?>