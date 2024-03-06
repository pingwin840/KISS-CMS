<?php
// Файл, в который будут сохраняться посты
$filePath = 'blog_posts.json';
// Пароль для добавления постов, замените на ваш пароль
$correctPassword = 'YourSecurePassword';
// Сообщение об ошибке или успехе
$uploadStatus = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($password === $correctPassword && $title !== '' && $content !== '') {
        // Если пароль прошёл проверку и заполнены все поля
        $title = strip_tags($title);
        $content = strip_tags($content);

        // Создаём массив с данными нового поста
        $newPost = [
            'title' => $title,
            'content' => $content,
            'date' => date('Y-m-d H:i:s')
        ];

        // Пытаемся получить и декодировать существующие посты
        $postsJson = file_exists($filePath) ? file_get_contents($filePath) : '[]';
        $posts = json_decode($postsJson, true) ?: [];

        // Добавляем новый пост в начало массива
        array_unshift($posts, $newPost);

        // Записываем обновлённые данные обратно в файл
        if (file_put_contents($filePath, json_encode($posts))) {
            $uploadStatus = 'Пост успешно опубликован!';
        } else {
            $uploadStatus = 'Не удалось записать пост в файл!';
        }
    } else {
        $uploadStatus = 'Неверный пароль или не все поля заполнены!';
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Создать пост</title>
</head>
<body>

<h1>Создать новый пост</h1>

<p><?php echo htmlspecialchars($uploadStatus); ?></p>

<form action="" method="post">
    <input type="text" name="title" placeholder="Название поста" required>
    <textarea name="content" placeholder="Текст поста" required></textarea>
    <input type="password" name="password" placeholder="Пароль" required>
    <input type="submit" value="Опубликовать">
</form>

</body>
</html>
