<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Магазин одежды</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <a href="index.php"><h1><span class="logo_part1">Стиль</span><span class="logo_part2"> Одежда</span></h1></a>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Главная</a></li>
                    <li><a href="shop.php">Магазин</a></li>
                    <li><a href="contacts.php">Контакты</a></li>
                    <?php
                    session_start();
                    if (isset($_SESSION['user_id'])) {
                        echo '<li><a href="logout.php">Выйти</a></li>';
                        echo '<li class="cart-icon"><a href="#">Список покупок <span id="cart-count"></span></a>';
                        echo '<ul id="cart-dropdown" class="cart-dropdown">';
                        echo '<div id="cart-items"></div>';
                        echo '<button class="checkout-button" onclick="location.href=\'cart.php\'">Оформить заказ</button>';
                        echo '</ul>';
                        echo '</li>';
                        
                    } else {
                        echo '<li><a href="login.php">Войти</a></li>';
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </header>
    <main>