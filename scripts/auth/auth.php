<?php
require_once '../db.php';

$username = trim($_POST['username']);
$pass = trim($_POST['password']);

if (!empty($username) && !empty($pass)) {

    if (strlen($pass) > 18 && strlen($pass) < 8) {
        echo "<script> alert('Недопустимая длина пароля') </script>";
    }else {

        $query = 'SELECT username, password FROM users WHERE username = :username';
        $params = [':username' => $username];
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);

        $user = $stmt->fetch(PDO::FETCH_OBJ);

        if($user) {
            if (password_verify($pass, $user->password)) {

                $_SESSION['user_username'] = $user->username;

                header('Location: ../../index.php');
            }else {
                header("refresh:0; url=auth_form.html");
                echo "<script> alert('Указан неверный пароль') </script>";
            }
        }else {
            header("refresh:0; url=auth_form.html");
            echo "<script> alert('Неверно указано имя пользователя или пароль') </script>";
        }
    }

} else {
    header("refresh:0; url=auth_form.html");
    echo "<script> alert('Заполните все поля') </script>";
}