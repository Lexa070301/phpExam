<?php
include 'functions.php';
$session_id = $_GET['id'];
$questions = mysqli_fetch_all(mysqli_query($database, "SELECT * FROM questions WHERE session_id = '$session_id'"), MYSQLI_BOTH);
if (isset($_POST["submit"])) {
    $ip = $_SERVER['REMOTE_ADDR'];
    //echo $_POST['radio_5-1'];
    $checkboxes = $_POST['checkbox_6-1-'];
    echo count($checkboxes);
    //mysqli_query($database, "INSERT INTO user_answers (ip, datetime, session_id, question_id, answer, points) VALUES ($ip, NOW(), $session_id, )");
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
echo '<form action="" method="post">';
for ($i = 0; $i < count($questions); $i++) {
    $question = $questions[$i]['question'];
    $count = 0;
    $values = [];
    $counter_1 = 1;
    $counter_2 = 1;
    $counter_3 = 1;
    $counter_4 = 1;
    $counter_5 = 1;
    $counter_6 = 1;
    switch ($questions[$i]['question_type']) {
        case 1:
            echo "<label>$question</label>" . '<br>';
            echo "<input required type='number' name='number_1-$counter_1'>";
            $counter_1++;
            echo '<br>';
            break;
        case 2:
            echo "<label>$question</label>" . '<br>';
            echo "<input required type='number' name='number_2-$counter_2' min='0'>";
            $counter_2++;
            echo '<br>';
            break;
        case 3:
            echo "<label>$question</label>" . '<br>';
            echo "<input required type='text' name='text_3-$counter_3' minlength='1' maxlength='30'>";
            $counter_3++;
            echo '<br>';
            break;
        case 4:
            echo "<label>$question</label>" . '<br>';
            echo "<textarea required style='resize: none; width: 200px; height: 100px' name='text_4-$counter_4' minlength='1' maxlength='30'></textarea>";
            $counter_4++;
            echo '<br>';
            break;
        case 5:
            $count = substr_count($questions[$i]['answer'], ',') + 1;
            $values = explode(",", $questions[$i]['answer']);
            echo "<label>$question</label>" . '<br>';
            for ($j = 0; $j < $count; $j++) {
                echo "<input required type='radio' name='radio_5-$counter_5' value='" . stristr($values[$j], '-', true) . "'>";
                echo "<span>" . stristr($values[$j], '-', true) . "</span>" . '<br>';
            }
            $counter_5++;
            echo '<br>';
            break;
        case 6:
            $count = substr_count($questions[$i]['answer'], ',') + 1;
            $values = explode(",", $questions[$i]['answer']);
            echo "<label>$question</label>" . '<br>';
            for ($j = 0; $j < $count; $j++) {
                echo "<input type='checkbox' name='checkbox_6-" . $counter_6 . "[]' value='" . stristr($values[$j], '-', true) . "'>";
                echo "<span>" . stristr($values[$j], '-', true) . "</span>" . '<br>';
            }
            $counter_6++;
            echo '<br>';
            break;
    }
}
echo '<input type="submit" value="Отправить" name="submit">';
echo '</form>';
?>
<script src="js/main.js"></script>
</body>
</html>
