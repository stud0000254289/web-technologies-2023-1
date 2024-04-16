<?php
// Установка часового пояса для корректной работы с временем
date_default_timezone_set('Europe/Moscow');

// Переменные для использования в HTML
$title = "Добро пожаловать на наш сайт";
$heading = "Главная страница";
$currentYear = date('Y');

// Функция для вывода текущего времени с правильными склонениями
function formatTime() {
    $hours = date('G');
    $minutes = date('i');

    // Определение правильной формы слова "час"
    if ($hours == 1 || $hours == 21) {
        $hoursSuffix = 'час';
    } elseif (in_array($hours, [2, 3, 4, 22, 23, 24])) {
        $hoursSuffix = 'часа';
    } else {
        $hoursSuffix = 'часов';
    }

    // Определение правильной формы слова "минута"
    $minutesLastDigit = $minutes % 10;
    if ($minutesLastDigit == 1 && $minutes != 11) {
        $minutesSuffix = 'минута';
    } elseif (in_array($minutesLastDigit, [2, 3, 4]) && !in_array($minutes, [12, 13, 14])) {
        $minutesSuffix = 'минуты';
    } else {
        $minutesSuffix = 'минут';
    }

    return "$hours $hoursSuffix $minutes $minutesSuffix";
}
?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
</head>
<body>
    <header>
        <h1><?php echo $heading; ?></h1>
    </header>
    <main>
        <p>текущий время: <?php echo formatTime(); ?>.</p>
        <footer>
            <p>текущий год: <?php echo $currentYear; ?> </p>
        </footer>
    </main>
</body>
</html>
