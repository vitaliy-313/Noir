<?php session_start() ?>
<link rel="stylesheet" href="/css/auth.css">


<form class="auth-form" action="/app/admin/tables/auth_check.php" method="POST">
    <h2>Авторизация</h2>

    <div class="auth-form-inp">
        <label for="phone">Введите телефон</label>
        <input id="phone" class="input-auth" name="phone" type="tel" pattern="(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?" title="Введите номер телефона в формате +7 XXX XXX XX XX" value="<?= $_SESSION['save-info']['phone'] ?? "" ?>" required>
    </div>

    <div class="auth-form-inp">
        <label for="password">Введите пароль</label>
        <input type="password" class="input-auth" name="password" id="password">
    </div>
    <?php if (!empty($_SESSION['error'])) : ?>

        <p> <?= $_SESSION['error'] ?? "" ?></p>

    <?php endif ?>

    <br><br>
    <button name="btnAuth">Войти</button>
</form>

<!-- Подключение библиотеки jQuery -->
<script src="/assets/script/script/jquery.js"></script>
<!-- Подключение jQuery плагина Masked Input -->
<script src="/assets/script/script/jquery.maskedinput.js"></script>

<script defer src="/assets/script/logout.js"></script>