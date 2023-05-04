<?php

use App\models\Client;

include $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";
unset($_SESSION['error']);
if (isset($_POST["btnAuth"])) {

    //имя
    // регулярные выраения

    if (!preg_match('/^[А-ЯЁ][а-яё]+$/u', $_POST['name'])) {
        $_SESSION['error']['name'] = 'Имя введено некорректно';
        if ($_POST["name"] == null) {
            $_SESSION["error"]["name"] = "заполните поле";
            header("Location: /app/users/create.php");
        }
    }
    //фамилия
    if (!preg_match('/^[А-ЯЁ][а-яё]+$/u', $_POST['surname'])) {
        $_SESSION['error']['surname'] = 'Фамилия введена некорректно';
        if ($_POST["surname"] == null) {
            $_SESSION["error"]["surname"] = "заполните поле";
            header("Location: /app/users/create.php");
        }
    }
    //номер телефона
    if (!preg_match('/^[+]7|8[0-9()-]{10}$\\s/', $_POST['phone'])) {
        $_SESSION['error']['phone'] = 'Телефон введен некорректно';
        if ($_POST["phone"] == null) {
            $_SESSION["error"]["phone"] = "заполните поле";
            header("Location: /app/users/create.php");
        }
    }

    // пароль
    if (preg_match('/^\S*(?=\S{6,20})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $_POST['password'])) {
        if ($_POST["password"] == null) {
            $_SESSION["error"]["password"] = "заполните поле";
        } else {
            if ($_POST["password"] == $_POST["password_confirmation"]) {
                
                if (!Client::getClient($_POST["phone"], $_POST["password"]) != null) {
                    
                    if (Client::store($_POST)) {
                        $user = Client::getClient($_POST["phone"], $_POST["password"]);

                        $_SESSION["auth"] = true;
                        $_SESSION["id"] = $user->id;
                        $_SESSION["name"] = $_POST["name"];
                        header("Location: /");
                        die();
                    }
                } else {
                    $_SESSION["save-info"]["name"] = $_POST["name"];
                    $_SESSION["save-info"]["surname"] = $_POST["surname"];
                    $_SESSION["save-info"]["phone"] = $_POST["phone"];
                    $_SESSION["save-info"]["password"] = $_POST["password"];
                    $_SESSION["auth"] = false;
                    $_SESSION["error"]["reg"] = "вы уже зарегистрированы";
                    header("Location: /app/users/create.php");
                    die();
                }
            } else {
                $_SESSION["save-info"]["name"] = $_POST["name"];
                $_SESSION["save-info"]["surname"] = $_POST["surname"];
                $_SESSION["save-info"]["phone"] = $_POST["phone"];
                $_SESSION["save-info"]["password"] = $_POST["password"];
                $_SESSION["auth"] = false;
                $_SESSION["error"]["reg"] = "разные пароли";
                header("Location: /app/users/create.php");
                die();
            }
        }
    } else{
        $_SESSION['error']['password'] = 'Пароль введен некорректно';
    }

    if(isset($_SESSION['error'])){
        header("Location: /app/users/create.php");
    }
}
