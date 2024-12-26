<?php include 'includes/header.php'; ?>

<?php
include 'includes/db_connect.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $pdo->prepare('SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE p.id = ?');
$stmt->execute([$id]);
$product = $stmt->fetch();

if ($product) :
?>
    <div class="product-detail">
        <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
        <div class="product-info">
            <h2><?= $product['name'] ?></h2>
            <p>Категория: <?= $product['category_name'] ?></p>
            <p>Описание: <?= $product['description'] ?></p>
            <p>Цена: $<?= $product['price'] ?></p>
            <p>В наличии: <?= $product['stock_quantity'] ?></p>
            <?php if (isset($_SESSION['user_id'])): ?>
                <button class="add-to-cart-button" data-product-id="<?= $product['id'] ?>">Добавить в список покупок</button>
            <?php endif; ?>
        </div>
    </div>
<?php else : ?>
    <p>Товар не найден.</p>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>