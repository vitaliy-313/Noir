<?php

use App\models\Category;

include $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";
if (!isset($_SESSION['admin']) || !$_SESSION["admin"]) {
    header("Location: /app/admin/tables/logout.php");
    die();
}
//получаем поток для работы с данными
$stream =file_get_contents("php://input");
if ($stream != null){
    //декодируем полученные данные
    $category=json_decode($stream)->data;
    $action = json_decode($stream)->action;

    $Category = match($action){   
       "add"=> Category::add($category),
       "delete"=> Category::delete($category),
    };
    echo json_encode([
        "Category" => $Category,
    ], JSON_UNESCAPED_UNICODE);
}
