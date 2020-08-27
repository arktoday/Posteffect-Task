<?php
require_once '../db.php';

$id = trim($_POST['id']);
$username = trim($_POST['username']);
$email = trim($_POST['email']);
$text = trim($_POST['text']);

if (!empty($username) && !empty($email) && !empty($text)) {

    $query = 'UPDATE task SET username = :username, email = :email, text = :text WHERE id = :id';
    $params = [':username' => $username, ':email' => $email, ':text' => $text, ':id' => $id];
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);

    header("refresh:0; url=../../index.php");

} else {
    header("refresh:0; url=edit_task_form.php");
    echo "<script> alert('Заполните все поля') </script>";
}
