<?php
// Файл, в который мы будем записывать сообщения
$filePath = 'guestbook.txt';

// Обработка данных формы, если форма была отправлена
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['message']) && !empty($_POST['nickname'])) {
    // Получаем безопасный ник и сообщение
    $nickname = strip_tags(trim($_POST['nickname']));
    $message = strip_tags(trim($_POST['message']));
    // Добавляем текущее время к сообщению
    $newEntry = date('Y-m-d H:i:s') . " - " . $nickname . ': ' . $message . "\n";
    // Добавляем запись в файл
    file_put_contents($filePath, $newEntry, FILE_APPEND);
    $upload_status = "Сообщение добавлено!";
} else {
    $upload_status = "Необходимо заполнить все поля!";
}

// Чтение данных из файла
$guestbookData = file_exists($filePath) ? file_get_contents($filePath) : 'Пока что нет сообщений.';

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Гостевая книга</title>
</head>
<body>

<h1>Гостевая книга</h1>

<?php if (!empty($upload_status)): ?>
<p><?php echo htmlspecialchars($upload_status); ?></p>
<?php endif; ?>

<form action="" method="post">
    <input type="text" name="nickname" placeholder="Ваш ник" required>
    <textarea name="message" placeholder="Ваше сообщение" required></textarea>
    <input type="submit" value="Оставить сообщение">
</form>

<h2>Сообщения:</h2>
<pre><?php echo htmlspecialchars($guestbookData); ?></pre>

</body>
</html>