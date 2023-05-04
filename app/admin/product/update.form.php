<?php

use App\models\Product;

include $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

if (!isset($_SESSION['admin']) || !$_SESSION["admin"]) {
    header("Location: /app/admin/tables/logout.php");
    die();
}
$extensions = ["jpeg", "jpg", "png", "webp", "jfif"];
$types = ["image/jpeg", "image/jpg", "image/png", "image/jfif"];

$product = Product::find($_POST['id']);

if (isset($_POST['btn'])) {

    $delImage = $product->image;
    unlink("D:/Новая папка (2)/OSPanel/domains/php-demo-floris-fetch-check/upload/" . $delImage);

    $_POST['image']= $product->image;
    if (isset($_FILES["image"]) && !empty($_FILES["image"]['name'])) {
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
                    if (!move_uploaded_file($tmpName, $_SERVER['DOCUMENT_ROOT'] . "/upload/" . $newName)) {
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
            $_SESSION['error'] = "ошиба" . implode(",", $extensions);
        }

        if (empty($_SESSION['error'])) {
            $_SESSION['good'] = "все хорошо";
            $_POST['image'] = $newName;
        } 
    }


    Product::updateProduct($_POST);
    unset($_SESSION);
}
header("Location: /app/admin/tables/product.php");
