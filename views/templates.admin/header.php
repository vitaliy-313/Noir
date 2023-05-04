<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/admin.css">

</head>

<body>

<div class="container">
        <ul class="nav navbar">
            <li><a href="/app/admin/" class="nav-li-a"><img class="logo admin-logo" src="/upload/Frame 34.png" alt=""></a></li>
            <li><a href="/app/admin/tables/category.php" class="nav-li-a nav-menu">Категории</a></li>
            <li><a href="/app/admin/tables/product.php" class="nav-li-a">Товары</a></li>
            <li><a href="/app/admin/tables/order.php" class="nav-li-a">Заказы</a></li>

            <?php if (!isset($_SESSION['admin']) || !$_SESSION['admin']) : ?>

                <li class="nav-link "><a class="a-admin" href="/app/admin/tables/auth.php">Войти</a></li>

            <?php else : ?>

                <li class="nav-link "><a class="a-admin" href="/app/users/logout.php">Выйти</a></li>


            <?php endif ?>
        </ul>