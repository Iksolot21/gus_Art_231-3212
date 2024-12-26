<?php
session_start();
include 'includes/db_connect.php';

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    if (empty($username) || empty($password) || empty($email)) {
        $error_message = 'Пожалуйста, заполните все поля.';
    } else {
        $stmt = $pdo->prepare('SELECT id FROM users WHERE username = ?');
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            $error_message = 'Пользователь с таким именем уже существует.';
        } else {
            $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                $error_message = 'Пользователь с таким email уже существует.';
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                $stmt = $pdo->prepare('INSERT INTO users (username, password, email) VALUES (?, ?, ?)');
                if ($stmt->execute([$username, $hashed_password, $email])) {
                    $user_id = $pdo->lastInsertId();
                    $_SESSION['user_id'] = $user_id;
                    header('Location: index.php');
                    exit;
                } else {
                    $error_message = 'Ошибка при регистрации.';
                }
            }
        }
    }
}

include 'includes/header.php';
?>

<h2>Регистрация</h2>

<?php if ($error_message): ?>
    <p class="error-message"><?= $error_message ?></p>
<?php endif; ?>

<form action="register.php" method="post">
    <label for="username">Имя пользователя:</label>
    <input type="text" name="username" id="username" required>

    <label for="password">Пароль:</label>
    <input type="password" name="password" id="password" required>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>

    <input type="submit" value="Зарегистрироваться">
</form>

<p>Уже зарегистрированы? <a href="login.php">Войти</a></p>

<?php include 'includes/footer.php'; ?>