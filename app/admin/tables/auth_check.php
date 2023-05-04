<?php

use App\models\Client;


include $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

unset($_SESSION['error']);

if (isset($_POST['btnAuth'])) {
    $user = Client::getClient($_POST['phone'], $_POST['password']);
    $_SESSION['admin'] = false;
    if ($user == null) {
        $_SESSION['error'] = "Пользователь не найден";
        header("Location: /app/admin/tables/logout.php");
        die();
    } else {

        if ($user->role !== 'Администратор') {
            $_SESSION['error'] = "Доступ запрещен";
            header("Location: /app/admin/tables/logout.php");
            die();
        }
        $_SESSION['admin'] = true;
        $_SESSION['id'] = $user->id;
        header("Location: /app/admin/");
    }
}
