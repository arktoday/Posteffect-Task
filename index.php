<?php
require_once 'scripts/db.php';
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Задачи</title>
</head>
<body>
<!--Navigation bar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="col">
        <?php if (isset($_SESSION['user_username'])) {
            echo "<a href=\"scripts/logout.php\" class=\"btn btn-outline-light float-right\">Выход</a>";
        } else {
            echo "<a href=\"scripts/auth/auth_form.html\" class=\"btn btn-outline-light float-right\">Авторизация</a>";
        }?>
<!--        Modal open button-->
        <button class="btn btn-warning" role="button" data-toggle="modal" data-target="#addingModal">Добавить задачу</button>
    </div>
</nav>

<!--Modal for adding task-->
<div class="modal fade" id="addingModal" tabindex="-1" aria-labelledby="addingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addingModalLabel">Новая задача</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="scripts/task/add_task.php">
                    <div class="form-group">
                        <label class="col-form-label">Имя пользователя:</label>
                        <input type="text" class="form-control" name="username">
                        <label class="col-form-label">Email:</label>
                        <input type="text" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Текст:</label>
                        <textarea required class="form-control" name="text"></textarea>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Создать"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Tasks-->
<div class="list-group">
    <?php

    $result = $pdo->query('SELECT * FROM task');

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
?>
        <a href="#" class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1"><?= $row['username'] ?></h5>
                <small class="text-muted"><?= $row['email'] ?></small>
            </div>
            <p class="mb-1"><?= $row['text'] ?></p>

            <?php
            if (isset($_SESSION['user_username'])) {

                echo "<form method='post' action='scripts/task/edit_task_form.php'><button type=\"submit\" class=\"btn btn-success mt-3\" value=\"".$row['id']."\" name=\"edit\">Редактировать</button></form><br>";
                echo "<form method='post' action='scripts/task/delete_task.php'><button type=\"submit\" class=\"btn btn-outline-danger\" value=\"".$row['id']."\" name=\"delete\">Удалить</button></form>";
            } ?>
        </a>
<?php
    }
    ?>


</div>

<!--Bootstrap scripts-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</body>
</html>