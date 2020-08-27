<?php
require_once '../db.php';

$username = trim($_POST['username']);
$email = trim($_POST['email']);
$text = trim($_POST['text']);

if (!empty($username) && !empty($email) && !empty($text)) {

    $query = 'INSERT INTO task VALUES (NULL, :username, :email, :text)';
    $params = [':username' => $username, ':email' => $email, ':text' => $text];
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);

    header("refresh:0; url=../../index.php");

} else {
    header("refresh:0; url=../../index.php");
    echo "<script> alert('Заполните все поля') </script>";
}
