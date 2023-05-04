
<?php

use App\models\Order;
use App\models\Statuses;

include $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";
if (!isset($_SESSION['admin']) || !$_SESSION["admin"]) {
    header("Location: /app/admin/tables/logout.php");
    die();
}
$order= Order::find($_GET["id"]);
$status = Statuses::all();
include $_SERVER["DOCUMENT_ROOT"] . "/views/admin/order/order.update.view.php";
