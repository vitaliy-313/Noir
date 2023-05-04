<?php
include $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

// unset($_SESSION['auth']);
session_unset();
session_destroy();

header("Location: /");