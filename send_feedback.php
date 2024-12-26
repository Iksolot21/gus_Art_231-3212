<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    echo "<h2>Спасибо за ваше сообщение, $name!</h2>";
    echo "<p>Мы свяжемся с вами по email: $email</p>";
    echo "<p>Ваше сообщение: $message</p>";
} else {
    echo "<p>Ошибка отправки сообщения.</p>";
}
?>