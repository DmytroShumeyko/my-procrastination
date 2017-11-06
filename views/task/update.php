<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>


            <h4>Редактировать Задание #<?php echo $id; ?></h4>

            <br/>

            <div class="col-sm-8 col-sm-offset-2">
                <div class="login-form">
                    <form action="" method="post">
                        <div class="input-field">
                            <input type="text" class="form-control" id="task_name" name="task_name"
                                   value="<?= $task['task_name'] ?>">
                            <label for="task_name">Name</label>
                        </div>

                        <div class="input-field">
                            <textarea class="materialize-textarea" id="description" name="description"><?= $task['description'] ?></textarea>
                            <label for="description">Description</label>
                        </div>

                        <div class="form-group">
                            <div class="textcenter">
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>

