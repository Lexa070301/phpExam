<?php
include 'functions.php';
if (isset($_POST["submit"])) {
    session_start();
    $login = filter_var(trim($_POST['login']), FILTER_SANITIZE_EMAIL);
    $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
    $hesh = mysqli_fetch_all(mysqli_query($database, "SELECT * FROM users WHERE login = '$login'"), MYSQLI_BOTH);
    $temp = '';
    if (count($hesh) == 0) {
        $temp = 'not found';
    } else
        if (password_verify(super_hash($password), $hesh[0]['password'])) {
            $_SESSION['admin'] = true;
            $_SESSION['login'] = $login;
        } else {
            $temp = 'incorrect';
        }
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exam</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php if (!isset($_SESSION['admin'])): ?>
    <form action="" method="post" class="enter">
        <input required type="text" name="login" class="login form-input"
               placeholder="Ваш логин">
        <input required type="password" name="password" class="password form-input"
               placeholder="Введите пароль">
        <input class="submit" type="submit" name="submit" value="Войти">
        <?php
        if ($temp == 'not found') {
            echo '<span style="color: red">Пользователь не найден</span>';
        } else if ($temp == 'incorrect') {
            echo '<span style="color: red">Неверные данные</span>';
        }
        ?>
    </form>
<?php endif; ?>
<?php if (isset($_SESSION['admin']) && ($_SESSION['admin'])): ?>
    <h2>Добрый день, <?= $_SESSION['login'] ?></h2>

<?php endif; ?>
<script src="js/main.js"></script>
</body>
</html>