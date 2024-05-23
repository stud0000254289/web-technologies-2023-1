<?php

$targetDir = "images/";
$thumbsDir = $targetDir . "thumbs/";
$targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
$errorMessages = [];

// Убедимся, что папка для миниатюр существует
if (!file_exists($thumbsDir)) {
    mkdir($thumbsDir, 0777, true);
}

// Проверка, является ли файл изображением
$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
if ($check !== false) {
    // Проверка размера файла
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        $errorMessages[] = "Файл слишком большой.";
    } else {
        // Проверка формата файла
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $errorMessages[] = "Только JPG, JPEG, PNG & GIF файлы разрешены.";
        } else {
            // Попытка загрузить файл
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
                // Создание миниатюры
                createThumbnail($targetFile, $thumbsDir . basename($_FILES["fileToUpload"]["name"]), 100);
                echo "Файл " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " был загружен.";
            } else {
                $errorMessages[] = "Произошла ошибка при загрузке файла.";
            }
        }
    }
} else {
    $errorMessages[] = "Файл не является изображением.";
}

if (!empty($errorMessages)) {
    foreach ($errorMessages as $message) {
        echo $message . "<br>";
    }
    exit();
} else {
    header('Location: index.php');
    exit();
}

// Функция создания миниатюры
function createThumbnail($src, $dest, $desiredWidth) {
    $info = getimagesize($src);
    switch ($info['mime']) {
        case 'image/jpeg':
            $sourceImage = imagecreatefromjpeg($src);
            break;
        case 'image/png':
            $sourceImage = imagecreatefrompng($src);
            break;
        case 'image/gif':
            $sourceImage = imagecreatefromgif($src);
            break;
        default:
            echo "Unsupported image type!";
            return false;
    }

    if (!$sourceImage) {
        echo "Failed to create image from file.";
        return false;
    }

    $width = imagesx($sourceImage);
    $height = imagesy($sourceImage);
    $desiredHeight = floor($height * ($desiredWidth / $width));
    $virtualImage = imagecreatetruecolor($desiredWidth, $desiredHeight);

    if ($info['mime'] == 'image/png') {
        imagecolortransparent($virtualImage, imagecolorallocatealpha($virtualImage, 0, 0, 0, 127));
        imagealphablending($virtualImage, false);
        imagesavealpha($virtualImage, true);
    }

    imagecopyresampled($virtualImage, $sourceImage, 0, 0, 0, 0, $desiredWidth, $desiredHeight, $width, $height);
    switch ($info['mime']) {
        case 'image/jpeg':
            imagejpeg($virtualImage, $dest);
            break;
        case 'image/png':
            imagepng($virtualImage, $dest);
            break;
        case 'image/gif':
            imagegif($virtualImage, $dest);
            break;
    }
    return true;
}
?>
