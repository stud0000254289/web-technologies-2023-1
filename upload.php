<?php

// Путь к директории для загружаемых изображений
$targetDir = "images/";
$targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);
$imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));


$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
if($check !== false) {
    
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Файл слишком большой.";
    } else {
        
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Только JPG, JPEG, PNG & GIF файлы разрешены.";
        } else {
           
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
               
                createThumbnail($targetFile, $targetDir . 'thumbs/' . basename($_FILES["fileToUpload"]["name"]), 100);
                echo "Файл ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " был загружен.";
            } else {
                echo "Произошла ошибка при загрузке файла.";
            }
        }
    }
} else {
    echo "Файл не является изображением.";
}


header('Location: index.php');

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

