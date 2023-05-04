<?php include $_SERVER["DOCUMENT_ROOT"] . "/views/templates.admin/header.php"; ?>
<link rel="stylesheet" href="/css/admin.category.css">
<table class="table-category">
    <tr>
        <th>id</th>
        <th>Имя</th>
        <th colspan="3">Взаимодействия</th>
    </tr>
    <tbody class="categories-container">

        <?php foreach ($categories as $item) : ?>
            
                <tr class="categories" >

                    <th><?= $item->id ?></th>
                    <th><?= $item->name ?></th>
                    <th><button data-category-id="<?= $item->id ?>" class="btn btn-delete"> удалить</button></th>
                    <th><a href="/app/admin/categories/category.product.php?id=<?= $item->id ?>" class="btn btn-product">Товар</a></th>
                </tr>

        <?php endforeach ?>
        <tr>

            <th></th>
            <form class="add-category" action="/app/admin/categories/add.category.form.php" method="POST">

                <th><input type="text" name="name"></th>
                <th><button data-category-id="<?= $item->id ?>" name="btn" class="btn btn-add-category">Добавить</button> </th>
            </form>
        </tr>
    </tbody>
</table>
<script src="/assets/script/fetch.js"></script>
<script src="/assets/script/admin/admin.categories.update.js"></script>
<?php include $_SERVER["DOCUMENT_ROOT"] . "/views/templates.admin/footer.php"; ?>