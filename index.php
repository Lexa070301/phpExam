<?php
include 'functions.php';
if (isset($_POST["submit"])) {
    $login = filter_var(trim($_POST['login']), FILTER_SANITIZE_EMAIL);
    $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
    $hesh = mysqli_fetch_all(mysqli_query($database, "SELECT * FROM users WHERE login = '$login'"), MYSQLI_BOTH);
    $temp = '';
    if (count($hesh) == 0) {
        $temp = 'not found';
    } else
        if (password_verify(super_hash($password), $hesh[0]['password'])) {
            setcookie('admin', true, time()+3600);
            setcookie('login', $login, time()+3600);
        } else {
            $temp = 'incorrect';
        }
}
if (isset($_POST["create-session-submit"])) {
    mysqli_query($database, "INSERT INTO sessions (status) VALUES ('enabled')");
}
$sessions = mysqli_fetch_all(mysqli_query($database, "SELECT * FROM sessions"), MYSQLI_BOTH);
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
<?php if (!isset($_COOKIE['admin'])): ?>
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
<?php if (isset($_COOKIE['admin']) && ($_COOKIE['admin'])): ?>
    <h2>Добрый день, <?= $_COOKIE['login'] ?></h2>
    <form action="" method="post" class="create-session">
        <input type="submit" name="create-session-submit" class="create-session-submit" value="Новая сессия">
    </form>
    <ul class="sessions">
        <?php
        for ($i = 0; $i < count($sessions); $i++) {
            echo "<li class='sessions__item'>
                    <span class='sessions__item__status'>ID сессии: " . $sessions[$i]['id'] . "</span>
                    <span class='sessions__item__status'>Статут: " . $sessions[$i]['status'] . "</span>
                    <a class='sessions__item__link' href='session.php?id=" . $sessions[$i]['id'] . "'>Перейти к сесии</a>
                    <a class='sessions__item__link' href='protocol.php?id=" . $sessions[$i]['id'] . "'>Перейти к сесии</a>
                  </li>";
        }
        ?>
        <li></li>
    </ul>
<?php endif; ?>
<script src="js/main.js"></script>
</body>
</html>
<?php
mysqli_close($database);
?>