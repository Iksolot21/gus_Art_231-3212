<?php include 'includes/header.php'; ?>

<div class="slider">
    <div class="slides">
        <div class="slide"><img src="images/slide1.jpg" alt="Slide 1"></div>
        <div class="slide"><img src="images/slide2.jpg" alt="Slide 2"></div>
        <div class="slide"><img src="images/slide3.jpg" alt="Slide 3"></div>
    </div>
    <div class="slider-buttons">
        <button class="prev">Назад</button>
        <button class="next">Вперед</button>
    </div>
</div>

<div class="product-overview">
    <h2>Обзор продукции</h2>
    <div class="product-grid">
        <?php
        include 'includes/db_connect.php';
        $stmt = $pdo->query('SELECT * FROM products LIMIT 3');
        while ($row = $stmt->fetch()) {
            echo '<div class="product-card">';
            echo '<img src="' . $row['image'] . '" alt="' . $row['name'] . '">';
            echo '<h3>' . $row['name'] . '</h3>';
            echo '<p>' . $row['description'] . '</p>';
            echo '<p>Цена: $' . $row['price'] . '</p>';
            echo '<a href="product.php?id=' . $row['id'] . '" class="button">Подробнее</a>';
            echo '</div>';
        }
        ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>