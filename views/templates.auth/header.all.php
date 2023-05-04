<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/css/style.all.css">

</head>


<body>

    <div class="container container-nav">
        <a href="/" ><img class="logo" src="/upload/icons/logo-NOIR.png" alt=""></a>
        <ul class="nav navbar">

            <li><a href="/app/tables/products/menu.php" class="nav-li-a nav-menu">Меню</a></li>
            <li><a href="/app/tables/basket/basket.php" class="nav-li-a">Корзина</a></li>
            <li><a href="/app/tables/sale.php" class="nav-li-a">Акции</a></li>

            <li><a href="/app/tables/delivery.php" class="nav-li-a">Доставка</a></li>

            <?php if (!isset($_SESSION['auth']) || !$_SESSION['auth']) : ?>

                <li class="nav-link"><a href="/app/users/auth.php" class="nav-li-a">Войти</a></li>

            <?php else : ?>

                <li class="nav-link"><a href="/app/users/profile.php" class="nav-li-a">Профиль</a></li>

            <?php endif ?>
            <li><a href="/app/tables/map.php" class="nav-li-a">Челябинск, Курчатова 14</a></li>
        </ul>
        <hr class="line">
    </div>