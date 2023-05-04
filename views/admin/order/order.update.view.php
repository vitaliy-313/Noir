<?php include $_SERVER["DOCUMENT_ROOT"] . "/views/templates.admin/header.php"; ?>
<div>
    <form class="update-status-order" action="/app/admin/order/order.update.form.php" method="POST" enctype="multipart/form-data">
        
    <select name="status_id" id="">
            <?php foreach ($status as $item) : ?>
 
                <option value="<?= $item->id ?>" name=""><?= $item->name ?></option>
            <?php endforeach ?>
        </select>
        <input type="hidden" name="id" value="<?=$order[0]->order_id?>">
        <label for="reason_cancel">причина</label>
        <textarea name="reason_cancel" id="reason_cancel"  cols="30" rows="5"></textarea>
        
        <button class="btn btn-dark" name="btn">Добавить</button>
    </form>
</div>
<script defer src="/assets/script/admin/load.order.js"></script>
<?php include $_SERVER["DOCUMENT_ROOT"] . "/views/templates.admin/footer.php"; ?>