<?php

$driver = 'mysql';
$host = 'localhost';
$db_name = 'posteffect_task';
$db_user = 'root';
$db_pass = '';
$charset = 'utf8';
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

session_start();

try {
    $pdo = new PDO("$driver:host=$host; dbname=$db_name; charset=$charset", $db_user, $db_pass, $options);
}catch (PDOException $e) {
    die("Ошибка в подключении к базе данных");
}

