<footer>
<ul class="foot footer">
    <li><a href="/app/tables/products/menu.php" class="foot-li-a nav-menu">Меню</a></li>

    <li><a href="/app/tables/basket/basket.php" class="foot-li-a">Корзина</a></li>
    <li><a href="/app/tables/sale.php" class="foot-li-a">Акции</a></li>
    <?php if (!isset($_SESSION['auth']) || !$_SESSION['auth']) : ?>

        <li class="foot-link"><a href="/app/users/auth.php" class="foot-li-a">Войти</a></li>

    <?php else : ?>

        <li class="foot-link"><a href="/app/users/profile.php" class="foot-li-a">Профиль</a></li>

    <?php endif ?>
    <li><a href="/app/tables/delivery.php" class="foot-li-a">Доставка</a></li>

    <li><a href="/app/tables/map.php" class="foot-li-a">Адрес</a></li>
</ul>
<div class="and-footer">
    <img class="footer-icon" src="/upload/icons/inst.png" alt="">
    <img class="footer-icon" src="/upload/icons/TT.png" alt="">
    <img class="footer-icon" src="/upload/icons/VK.png" alt="">
    <h3 class="footer-all-adress">Адрес: Челябинск, Курчатова 14</h3>
</div>
</footer>
</div>
</body>

</html>