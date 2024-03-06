<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Галерея изображений</title>
    <style>
        .gallery img {
            width: 150px;
            margin: 5px;
            border: 2px solid #ccc;
            transition: border-color 0.3s;
        }
        .gallery img:hover {
            border-color: #f00;
        }
    </style>
</head>
<body>

<h1>Галерея изображений</h1>

<div class="gallery">
    <?php
    $imageDirectory = 'gallery/';
    // Открываем каталог и читаем его содержимое
    if (is_dir($imageDirectory)) {
        // Получаем массив файлов из каталога
        $files = array_diff(scandir($imageDirectory), array('.', '..'));
        // Проходим по массиву файлов
        foreach ($files as $file) {
            // Проверяем, является ли файл изображением
            $file_path = $imageDirectory . $file;
            if (is_file($file_path) && in_array(strtolower(pathinfo($file_path, PATHINFO_EXTENSION)), ['jpg', 'png', 'gif', 'jpeg'])) {
                echo "<a href='" . htmlspecialchars($file_path) . "' target='_blank'>";
                echo "<img src='" . htmlspecialchars($file_path) . "' alt='" . htmlspecialchars($file) . "'>";
                echo "</a>";
            }
        }
    } else {
        echo "Каталог изображений не найден.";
    }
    ?>
</div>

</body>
</html>