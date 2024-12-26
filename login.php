<?php
session_start();
include 'includes/db_connect.php';

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT id, password FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: index.php');
        exit;
    } else {
        $error_message = 'Неверное имя пользователя или пароль.';
    }
}

include 'includes/header.php';
?>

<h2>Авторизация</h2>

<?php if ($error_message): ?>
    <p class="error-message"><?= $error_message ?></p>
<?php endif; ?>

<form action="login.php" method="post">
    <label for="username">Имя пользователя:</label>
    <input type="text" name="username" id="username" required>

    <label for="password">Пароль:</label>
    <input type="password" name="password" id="password" required>

    <input type="submit" value="Войти">
</form>

<p>Еще не зарегистрированы? <a href="register.php">Зарегистрироваться</a></p>

<?php include 'includes/footer.php'; ?>