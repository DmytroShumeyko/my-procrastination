<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>


            <h4>Edit Task #<?php echo $id; ?></h4>

            <br/>

            <div class="col-sm-8 col-sm-offset-2">
                <div class="login-form">
                    <form action="" method="post">
                        <div class="input-field">
                            <input type="text" class="form-control" id="name" name="name"
                                   value="<?= $deal['name'] ?>">
                            <label for="task_name">Name</label>
                        </div>

                        <div class="input-field">
                            <textarea class="materialize-textarea" id="description" name="description"><?= $deal['description'] ?></textarea>
                            <label for="description">Description</label>
                        </div>
                        <div class="input-field">
                            <textarea class="materialize-textarea" id="why_not" name="why_not"><?= $deal['why_not'] ?></textarea>
                            <label for="why_not">Why not?</label>
                        </div>
                        <div class="input-field">
                            <input type="text" class="form-control" id="result" name="result"
                                   value="<?= $deal['result'] ?>">
                            <label for="result">Score</label>
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

