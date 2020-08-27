<?php
require_once '../db.php';

$username = trim($_POST['username']);
$pass = trim($_POST['password']);

if (!empty($username) && !empty($pass)) {

    if (strlen($pass) > 18 || strlen($pass) < 8) {
        header("refresh:0; url=reg_form.html");
        echo "<script> alert('Недопустимая длина пароля') </script>";
    }else {

        $query_exist = 'SELECT EXISTS( SELECT username FROM users WHERE username = :username)';
        $params_exist = [':username' => $username];
        $stmt_exist = $pdo->prepare($query_exist);
        $stmt_exist->execute($params_exist);

        if ( $stmt_exist->fetchColumn()) {
            header("refresh:3; url=reg_form.html");
            $die_str = 'Имя пользователя '.$username.' занято';
            die($die_str);
        }

        $pass = password_hash($pass, PASSWORD_DEFAULT);

        $query = 'INSERT INTO users(username, password) VALUES (:username, :password)';
        $params = [':username' => $username, ':password' => $pass];
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);

        header('Location: ../auth/auth_form.html');
    }

} else {
    header("refresh:0; url=reg_form.html");
    echo "<script> alert('Заполните все поля') </script>";
}
