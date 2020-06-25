<?php
include 'functions.php';
$session_id = $_GET['id'];
$answers = mysqli_fetch_all(mysqli_query($database, "SELECT * FROM user_answers WHERE session_id = '$session_id' ORDER BY ip"), MYSQLI_BOTH);
$answers_count = mysqli_fetch_all(mysqli_query($database, "SELECT count(ip) AS ip_count, SUM(points) AS points_count FROM user_answers WHERE session_id = '$session_id' GROUP BY ip ORDER BY ip"), MYSQLI_BOTH);

if (empty($answers)) {
    header('Location: index.php');
    exit();
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
<?php
$m = 0;
for ($k = 0; $k < count($answers_count); $k++) {
    echo '<table cellpadding="10px">';
    echo "<tr>";
    echo "<td>Номер вопроса</td>";
    echo "<td>IP Адрес</td>";
    echo "<td>Дата и Время</td>";
    echo "<td>Ответ</td>";
    echo "<td>Баллы</td>";
    echo "</tr>";
    for ($i = $m; $i < $answers_count[$k]['ip_count'] + $m; $i++) {
        $row = $answers[$i];
        echo "<tr>";
        for ($j = 0; $j < 7; $j++) {
            if ($j == 0) {
                $temp = $i + 1;
                echo "<td>$temp</td>";
            } else
                if (($j != 3) && ($j != 4)) {
                    echo "<td>$row[$j]</td>";
                }

        }
        echo "</tr>";
    };

    echo '</table>';
    echo '<span style="margin-bottom: 50px; display: block">Суммарный балл:' . $answers_count[$k]['points_count'] . '</span>';
    $m += $answers_count[$k]['ip_count'];
}
$sum = 0;
for ($i = 0; $i < count($answers_count); $i++) {
    $sum += $answers_count[$i]['points_count'];
}
echo '<span style="margin-bottom: 50px; display: block">Средний балл по сесии:' . $sum/count($answers_count) . '</span>';
?>
<script src="js/main.js"></script>
</body>
</html>
<?php
mysqli_close($database);
?>
