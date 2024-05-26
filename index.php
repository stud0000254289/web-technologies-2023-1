<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Галерея фотографий</title>
    <style>
        .gallery img {
            width: 150px;
            margin: 10px;
        }
    </style>
</head>
<body>
    <h1>Галерея фотографий</h1>
    <div class="gallery">
        <?php
        function logRequest() {
            $logDir = 'Logs/';
            $logFile = $logDir . 'log.txt';

            // Проверка существования папки Logs и создание, если не существует
            if (!is_dir($logDir)) {
                mkdir($logDir, 0777, true);
            }

            // Создание файла log.txt, если он не существует
            if (!file_exists($logFile)) {
                file_put_contents($logFile, '');
            }

            $logs = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $logCount = count($logs);

            if ($logCount >= 10) {
                // Получаем все файлы в директории Logs
                $logFiles = scandir($logDir);
                $logIndex = 0;

                // Ищем максимальный индекс среди файлов logX.txt
                foreach ($logFiles as $file) {
                    if (preg_match('/log(\d+)\.txt/', $file, $matches)) {
                        $logIndex = max($logIndex, intval($matches[1]));
                    }
                }

                // Увеличиваем индекс для нового файла
                $newLogFile = $logDir . 'log' . ($logIndex + 1) . '.txt';
                rename($logFile, $newLogFile);
                $logs = [];
            }

            $currentTime = date('Y-m-d H:i:s');
            $logs[] = "Request at $currentTime";

            file_put_contents($logFile, implode(PHP_EOL, $logs) . PHP_EOL);
        }

        logRequest();

        $dir = 'images';
        $images = scandir($dir);

        foreach($images as $image) {
            if ($image != '.' && $image != '..' && strpos($image, 'thumb_') !== 0) {
                echo "<a href='$dir/$image' target='_blank'><img src='$dir/thumb_$image' alt=''></a>";
            }
        }
        ?>
    </div>

    <h2>Загрузить новое изображение</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="image" accept="image/*" required>
        <button type="submit">Загрузить</button>
    </form>
</body>
</html>


