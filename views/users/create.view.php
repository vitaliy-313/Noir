<?php include $_SERVER["DOCUMENT_ROOT"] . "/views/templates.auth/header.php"; ?>

<link rel="stylesheet" href="/css/auth.css">

<body>

    <img class="auth-image" src="/upload/Noir.auth.png" alt="">
    <form class="auth-form" action="/app/users/insert.php" method="POST">
        <h2>Регистрация</h2>
        <div class="auth-form1">

            <div class="auth-form-inp">
                <label for="name">Имя</label>
                <input type="name" class="input-auth" name="name" value="<?= $_SESSION['save-info']['name'] ?? "" ?>">
                <p style="color:red;"><?= $_SESSION["error"]["name"] ?? "" ?></p>     
            </div>

            <div class="auth-form-inp">
                <label for="surname">Фамилия</label>
                <input class="input-auth" type="surname" name="surname" value="<?= $_SESSION['save-info']['surname'] ?? "" ?>">
                <p style="color:red;"><?= $_SESSION["error"]["surname"] ?? "" ?></p>
            </div>
            <div class="auth-form-inp">
                <label for="phone">Телефон</label>
                <input  id="phone" name="phone" class="input-auth" type="tel" pattern="(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?" title="Введите номер телефона в формате +7 XXX XXX XX XX" value="<?= $_SESSION['save-info']['phone'] ?? "" ?>" required>
                <p style="color:red;"><?= $_SESSION["error"]["phone"] ?? "" ?></p>
            </div>
            <div class="auth-form-inp">
                <label for="password">Пароль</label>
                <input class="input-auth" type="password" name="password" id="password">
                <p style="color:red;"><?= $_SESSION["error"]["password"] ?? "" ?></p>
            </div>
            <div class="auth-form-inp">
                <label for="password">Подтвердите пароль</label>
                <input class="input-auth" type="password" name="password_confirmation" id="password_confirmation">
                <p style="color: red;"><?= $_SESSION['error']['confirmation'] ?? '' ?></p>
                <p style="color:red;"><?= $_SESSION["error"]["reg"] ?? "" ?></p>
            </div>
            <div class="auth-form-inp check">
                <input type="checkbox" id="agreement" name="agreement" checked>
                <label for="agreement">Согласен на обработку пер. данных</label>
            </div>
        </div>


        <button class="btn-auth" name="btnAuth">Зарегистрироваться</button>
    </form>
    <a href="/views/users/auth.view.php" class="created">Войти</a>
</body>
<!-- Подключение библиотеки jQuery -->
<script src="/assets/script/script/jquery.js"></script>
<!-- Подключение jQuery плагина Masked Input -->
<script src="/assets/script/script/jquery.maskedinput.js"></script>

<script defer src="/assets/script/logout.js"></script>

<?php include $_SERVER["DOCUMENT_ROOT"] . "/views/templates/footer.php"; ?>