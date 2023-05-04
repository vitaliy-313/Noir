<?php include $_SERVER["DOCUMENT_ROOT"] . "/views/templates.admin/header.php"; ?>

<table >
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
    </tr>
    <tbody class="product-container">
        <tr>
        <?php foreach ($ProductByCategories as $item) : ?>
            <tr>
                <th><?=$item->id?></th>
                <th><img src="/upload/menu/<?=$item->photo?>" alt="" class="product-photo"></th>
                <th><?=$item->name?></th>
                <th><?=$item->price?></th>
                <th><?=$item->count?></th>
                <th><?=$item->description?></th>
                <th><?=$item->description_mini?></th>
                <th><?=$item->created_at?></th>
                <th><?=$item->updated_at?></th>
                <th><?=$item->category?></th>
            </tr>
        <?php endforeach ?>
        </tr>
    </tbody>
</table>

<?php include $_SERVER["DOCUMENT_ROOT"] . "/views/templates.admin/footer.php"; ?>