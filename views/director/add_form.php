<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="container">

<h4><?= $result ?></h4>

<form method="post" action="" class="container">
    <h4>Добавить задачу</h4>
        <div class="input-field">
            <input type="text" class="form-control" id="task_name" name="task_name" required>
            <label for="task_name">Название</label>
        </div>
        <div class="input-field">
            <textarea class="materialize-textarea" id="description" name="description"></textarea>
            <label for="description">Описание</label>
        </div>
        <div class="form-group">
            <div class="textcenter">
                <button type="submit" name="submit" class="btn btn-primary">Отправить</button>
            </div>
        </div>
</form>
</div>

<?php include ROOT . '/views/layouts/footer.php'; ?>