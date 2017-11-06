<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <br/>



            <h4>Delete Task #<?php echo $id; ?></h4>


            <p class="errorlist">Do you want to delete this task?</p>

            <form method="post">
                <div class="form-group">
                    <div class="col-xs-offset-5 col-xs-2">
                        <button type="submit" name="submit" class="btn btn-primary">Delete</button>
                    </div>
                </div>
             </form>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>

