<?php

use App\models\Client;

include $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";
unset($_SESSION['error']);

if (isset($_POST['btnAuth'])) {
    
    $user = Client::getClient($_POST['phone'], $_POST['password']);
    if ($user == null) {
        $_SESSION['auth'] = false;
        $_SESSION["error"]["unfined"] = "Пользователь не найден";
        header("Location: /app/users/auth.php");
        die();
    } else {

        $_SESSION['auth'] = true;
        $_SESSION['id']=$user->id;

        header("Location: /");
    }
}
