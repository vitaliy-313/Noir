<?php


use App\models\Product;
use App\models\Volume;

include $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

if (!isset($_SESSION['admin']) || !$_SESSION["admin"]) {
    header("Location: /app/admin/tables/logout.php");
    die();
}

$extensions = ["jpeg", "jpg", "png", "webp", "jfif"];
$types = ["image/jpeg", "image/jpg", "image/png", "image/jfif"];

if (isset($_FILES["image"])) {
    $name = $_FILES['image']['name'];
    $tmpName = $_FILES['image']['tmp_name'];
    $error = $_FILES['image']['error'];
    $size = $_FILES['image']['size'];
    $newName = time() . "_" . $name;
    $path_parts = pathinfo($name);

    if (in_array($path_parts["extension"], $extensions) && in_array(mime_content_type($tmpName), $types)) {
        if ($error == 0) {
            if (!($size < 2097152)) {
                $_SESSION['error'] = "не удалось переместить файл, слишком большой";
            } else {
                if (!move_uploaded_file($tmpName, $_SERVER['DOCUMENT_ROOT'] . "/upload/menu/" . $newName)) {
                    $_SESSION['error'] = "не удалось переместить файл";
                }
                if (!$error) {
                    $_SESSION['size'] = $size / 8 / 1024 / 1024;
                }
            }
        } else {
            $_SESSION['error'] = "есть ошибка";
        }
    } else {
        $_SESSION['error'] = "ошибка" . implode(",", $extensions);
    }

    if (empty($_SESSION['error'])) {
        $_SESSION['good'] = "все хорошо";
        $_POST['photo'] = $newName;
    }
};

if (isset($_POST['btn'])) {

    $ProductId= Product::addProduct($_POST);
    Volume::addValue($ProductId,$_POST);
    unset($_SESSION);
}
header("Location: /app/admin/tables/product.php");
