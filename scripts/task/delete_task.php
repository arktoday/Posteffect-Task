<?php
require_once '../db.php';

var_dump($_POST);

$query = 'DELETE FROM task WHERE id = :id';
$params = [':id' => $_POST['delete']];
$stmt = $pdo->prepare($query);
$stmt->execute($params);

header("refresh:0; url=../../index.php");
