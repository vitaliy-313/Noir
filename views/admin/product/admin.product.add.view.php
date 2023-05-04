<?php include $_SERVER["DOCUMENT_ROOT"] . "/views/templates.admin/header.php"; ?>
<link rel="stylesheet" href="/css/admin.add.category.css">

<form class="main" class="table-category" class="add-product" action="/app/admin/product/add.product.form.php" method="POST" enctype="multipart/form-data">
    <div class="once">
        <div class="product-form-inp">
            <p>Название товара</p>
            <input type="text" name="name" value="<?= $_SESSION['add-info']['name'] ?? "" ?>">
            <p style="color:red;"><?= $_SESSION["error"]["add-name"] ?? "" ?></p>
        </div>

        <div class="product-form-inp">
            <p>Количество товара</p>
            <input type="number" name="count" value="<?= $_SESSION['add-info']['count'] ?? "" ?>">
            <p style="color:red;"><?= $_SESSION["error"]["add-count"] ?? "" ?></p>
        </div>

        <div class="product-form-inp">
            <p>Описание товара</p>
            <textarea name="description" value="<?= $_SESSION['add-info']['description'] ?? "" ?>"></textarea>
            <p style="color:red;"><?= $_SESSION["error"]["add-description"] ?? "" ?></p>
        </div>

        <div class="product-form-inp">
            <p>Краткое описание товара</p>
            <textarea name="description_mini" value="<?= $_SESSION['add-info']['description_mini'] ?? "" ?>"></textarea>
            <p style="color:red;"><?= $_SESSION["error"]["add-description_mini"] ?? "" ?></p>
        </div>

        <div class="product-form-inp">
            <p>Картинка товара</p>
            <input type="file" name="image" id="image" value="<?= $_SESSION['add-info']['image'] ?? "" ?>">
            <p style="color:red;"><?= $_SESSION["error"]["add-image"] ?? "" ?></p>

            <img src="" id="loadedImage" alt="">
        </div>
    </div>

    <div class="product-form-inp">
        <p>Категория</p>
        <select name="category">
            <?php foreach ($categories as $item) : ?>
                <option value="<?= $item->id ?>"><?= $item->name ?></option>
            <?php endforeach ?>
        </select>
    </div>

    <div class="product-form-inp">
        <p>Объем</p>
        <p>Цена товара</p>
        <div class="card-price">

            <?php foreach ($volumes as $volume) : ?>
                <p><?= $volume->name ?></p>
                <input type="checkbox" name="volume_id[]" value="<?= $volume->id ?>">
                <input type="number" disabled hidden name="price[]" value="" id="<?= $volume->id ?>">
                <p style="color:red"><?= $_SESSION["error"]["add-price"] ?? "" ?></p>
            <?php endforeach ?>

        </div>
    </div>

    <div class="product-form-inp">
        <p>Измерение</p>
        <select name="unit">
            <?php foreach ($units as $unit) : ?>
                <option value="<?= $unit->id ?>"><?= $unit->name ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <button name="btn" class="btn">Добавить</button>
</form>
<script defer src="/assets/script/admin/load.Image.js"></script>
<script defer src="/assets/script/admin/card.price.js"></script>
<?php
unset($_SESSION['error']);
include $_SERVER["DOCUMENT_ROOT"] . "/views/templates.admin/footer.php"; ?>