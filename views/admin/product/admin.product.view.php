<?php include $_SERVER["DOCUMENT_ROOT"] . "/views/templates.admin/header.php"; ?>
<link rel="stylesheet" href="/css/admin.product.css">
<div class="container main">
    <!-- флажки по категориям -->

    <div class="check">
        <?php foreach ($categories as $category) : ?>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="category" id="<?= $category->id ?>" value="<?= $category->id ?>">
                <label class="form-check-label" for="<?= $category->id ?>">
                    <?= $category->name ?>
                </label>
            </div>
        <?php endforeach ?>
    </div>

    <!-- /флажки по категориям -->

    <div class="sort-add">
        <select name="sort" id="sort">
            <option value="ASC">Сначала дешевые</option>
            <option value="DESC">Сначала дорогие</option>
            <option value="startName">По алфавиту(от А до Я)</option>
            <option value="endName">По алфавиту(от Я до А)</option>
        </select>
        <a href="/app/admin/tables/add.product.php" class="btn">Добавить товар</a>
    </div>

    <table>
        <tr>
            <th>id</th>
            <th>Фото</th>
            <th>Название</th>
            <th>Цена</th>
            <th>Кол-во</th>
            <th>Описание</th>
            <th>Краткое описание</th>
            <th>Создание</th>
            <th>Обнавление</th>
            <th>Категория</th>
            <th colspan="3">Взаимодействия</th>
        </tr>
        <tbody class="product-container">

        </tbody>
    </table>
</div>
</div>
<script src="/assets/script/fetch.js"></script>
<script src="/assets/script/admin/admin.loadProducts.check.js"></script>
<?php include $_SERVER["DOCUMENT_ROOT"] . "/views/templates.admin/footer.php"; ?>