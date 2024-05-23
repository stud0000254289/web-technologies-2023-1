<?php
logRequest();

function logRequest() {
    $logDir = "logs/"; 
    $logFile = $logDir . "log.txt"; 

    // Убедимся, что папка для логов существует
    if (!file_exists($logDir)) {
        mkdir($logDir, 0777, true); 
    }

    // Чтение и запись в файл лога
    $current = file_exists($logFile) ? file_get_contents($logFile) : '';
    $current .= date("Y-m-d H:i:s") . "\n";
    file_put_contents($logFile, $current);

    // Проверка количества записей в log.txt
    $lines = file($logFile);
    if (count($lines) > 10) {
        $lastLogFile = glob($logDir . "log*.txt");
        usort($lastLogFile, function($a, $b) {
            return filemtime($a) - filemtime($b);
        });

        $lastLogNumber = count($lastLogFile) ? (int)filter_var(basename(end($lastLogFile)), FILTER_SANITIZE_NUMBER_INT) + 1 : 1;
        rename($logFile, $logDir . "log" . $lastLogNumber . ".txt");
    }
}

function buildGallery($dir) {
    $html = '';
    if (is_dir($dir)) {
        if ($handle = opendir($dir)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    $html .= '<a href="'.$dir.$entry.'" target="_blank"><img src="'.$dir.$entry.'" alt="'.$entry.'"></a>';
                }
            }
            closedir($handle);
        } else {
            $html = 'Failed to open directory: ' . $dir;
        }
    } else {
        $html = 'Directory not found: ' . $dir;
    }
    return $html;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Фотогалерея</title>
    <style>
        .gallery img {
            width: 100px; 
            margin: 10px;
        }
    </style>
</head>
<body>
    <div class="gallery">
        <?php
        echo buildGallery('images/'); 
        ?>
    </div>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        Выберите изображение для загрузки:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Загрузить изображение" name="submit">
    </form>
</body>
</html>
