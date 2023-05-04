<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="/css/style.index.css">
</head>


<body>

    <div class="container">
        <ul class="nav navbar">
            <li><a href="/" class="nav-li-a"><img class="logo" src="/upload/Frame 34.png" alt=""></a></li>
            <li><a href="/app/tables/products/menu.php" class="nav-li-a nav-menu">Меню</a></li>
            <li><a href="/" class="nav-li-a">Заказать кофе</a></li>
            <li><a href="/" class="nav-li-a">Акции</a></li>
            <li><a href="/app/tables/basket/basket.php" class="nav-li-a">Корзина</a></li>
            <li><a href="/" class="nav-li-a">Доставка</a></li>

            <?php if (!isset($_SESSION['auth']) || !$_SESSION['auth']) : ?>

                <li class="nav-link"><a href="/app/users/auth.php" class="nav-li-a">Войти</a></li>

            <?php else : ?>

                <li class="nav-link"><a href="/app/users/profile.php" class="nav-li-a">Профиль</a></li>

            <?php endif ?>
            <li><a href="/" class="nav-li-a">Адрес: Челябинск, Курчатова 14</a></li>
        </ul>
        <img class="nav-image-img" src="/upload/index.coffe.header.png" alt="">

    </div>  
</body>

</html>