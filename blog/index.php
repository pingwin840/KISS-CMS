<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Блог</title>
</head>
<body>

<h1>Блог</h1>

<?php
$filePath = 'blog_posts.json';
$posts = file_exists($filePath) ? json_decode(file_get_contents($filePath), true) : [];

if ($posts) {
    foreach ($posts as $post) {
        echo "<div>";
        echo "<h2>" . htmlspecialchars($post['title']) . "</h2>";
        echo "<p>" . nl2br(htmlspecialchars($post['content'])) . "</p>";
        echo "<small>Опубликовано: " . htmlspecialchars($post['date']) . "</small>";
        echo "</div>";
    }
} else {
    echo "Посты отсутствуют.";
}
?>

</body>
</html>