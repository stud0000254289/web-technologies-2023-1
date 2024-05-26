<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uploadDir = 'images/';
    $uploadFile = $uploadDir . basename($_FILES['image']['name']);
    $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES['image']['tmp_name']);

    if ($check === false) {
        die("Файл не является изображением.");
    }

    if ($_FILES['image']['size'] > 2000000) {
        die("Файл слишком большой.");
    }

    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($imageFileType, $allowedTypes)) {
        die("Разрешены только файлы JPG, JPEG, PNG и GIF.");
    }

    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
        $thumbnailWidth = 150;
        list($width, $height) = getimagesize($uploadFile);
        $thumbHeight = ($height / $width) * $thumbnailWidth;
        $thumbnail = imagecreatetruecolor($thumbnailWidth, $thumbHeight);

        switch ($imageFileType) {
            case 'jpg':
            case 'jpeg':
                $source = imagecreatefromjpeg($uploadFile);
                break;
            case 'png':
                $source = imagecreatefrompng($uploadFile);
                break;
            case 'gif':
                $source = imagecreatefromgif($uploadFile);
                break;
        }

        imagecopyresampled($thumbnail, $source, 0, 0, 0, 0, $thumbnailWidth, $thumbHeight, $width, $height);

        $thumbnailFile = $uploadDir . 'thumb_' . basename($_FILES['image']['name']);
        switch ($imageFileType) {
            case 'jpg':
            case 'jpeg':
                imagejpeg($thumbnail, $thumbnailFile);
                break;
            case 'png':
                imagepng($thumbnail, $thumbnailFile);
                break;
            case 'gif':
                imagegif($thumbnail, $thumbnailFile);
                break;
        }

        imagedestroy($thumbnail);
        imagedestroy($source);

        header('Location: index.php');
    } else {
        die("Ошибка загрузки файла.");
    }
}
?>



