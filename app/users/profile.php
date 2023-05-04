<?php
session_start();

use App\models\Client;
use App\models\Order;

include $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";


if (!isset($_SESSION['auth']) || !$_SESSION["auth"]) {
    header("Location: /app/users/create.php");
    die();
}

$user = Client::find($_SESSION["id"]);
$orders= Order::findInClient($_SESSION["id"]);


include $_SERVER["DOCUMENT_ROOT"] . "/views/users/profile.view.php";
