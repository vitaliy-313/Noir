<?php

use App\models\Order;

include $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

if (!isset($_SESSION['admin']) || !$_SESSION["admin"]) {
    header("Location: /app/admin/tables/logout.php");
    die();
}
    if($_GET['status_id'] == 2){
    Order::addStatuses($_GET);
    }
    else if (empty($_GET["reason_cancel"]) ) {
        $_SESSION['error']['reason_cancel']  = "Заполните поле";
        header("Location: /app/admin/tables/order.php");
        die();
    }
    else{
        Order::addStatuses($_GET);
    }




header("Location: /app/admin/tables/order.php");
