<?php

use App\models\Client;

include $_SERVER["DOCUMENT_ROOT"] ."/bootstrap.php";

$user = new Client();
$users = $user->all();

include $_SERVER["DOCUMENT_ROOT"] ."/";
