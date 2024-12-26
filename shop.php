<?php include 'includes/header.php'; ?>

<h2>Наш магазин</h2>

<table class="products-table">
    <thead>
        <tr>
            <th>Изображение</th>
            <th>Название</th>
            <th>Описание</th>
            <th>Цена</th>
            <th>Подробнее</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include 'includes/db_connect.php';
        $stmt = $pdo->query('SELECT * FROM products');
        while ($row = $stmt->fetch()) {
            echo '<tr>';
            echo '<td><img src="' . $row['image'] . '" alt="' . $row['name'] . '"></td>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['description'] . '</td>';
            echo '<td>$' . $row['price'] . '</td>';
            echo '<td><a href="product.php?id=' . $row['id'] . '" class="button">Подробнее</a></td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>

<?php include 'includes/footer.php'; ?>