<?php
require_once '../db.php';

$id = trim($_POST['edit']);

$query = 'SELECT username, email, text FROM task WHERE id = :id';
$params = [':id' => $id];
$stmt = $pdo->prepare($query);
$stmt->execute($params);

$task = $stmt->fetch(PDO::FETCH_ASSOC);

$username = $task['username'];
$email = $task['email'];
$text = $task['text'];

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="../../style.css">
    <title>Редактирование задачи</title>
</head>
<body>
<form method="post" action="edit_task.php">
    <div class="form-group">
        <label>Имя пользователя</label>
        <input type="text" class="form-control w-25" name="username" value="<?= $username ?>" autocomplete="new-password">
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="text" class="form-control w-25" name="email" value="<?= $email ?>" autocomplete="new-password">
        <label>Текст</label>
        <textarea required class="form-control w-25" name="text"><?= $text ?></textarea>
    </div>
    <button type="submit" class="btn btn-outline-primary ml-2" name="id" value="<?= $id ?>">Сохранить</button>
</form>
<a href="../../index.php" class="ml-3">Вернуться назад</a>
</body>
</html>