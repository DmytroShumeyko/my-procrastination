<?php include ROOT . '/views/layouts/header.php'; ?>

<section class="main">
    <div class="container">
        <div class="row">

            <div class="col-sm-4 col-sm-offset-4 padding-right">
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <ul class="errorlist">
                            <?php foreach ($errors as $error): ?>
                                <li> - <?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <div class="signup-form"><!--sign up form-->
                        <h2>Log in</h2>
                        <form method="post">
                                <div class="input-field">
                                    <input type="text" class="form-control" id="inputEmail" name="name">
                                    <label for="inputEmail">Name</label>
                                </div>
                                <div class="input-field">
                                    <input type="password" class="form-control" id="inputPassword" name="password">
                                    <label for="inputPassword">Password</label>
                                </div>
                            <p>
                                <input type="checkbox" class="filled-in" id="filled-in-box" checked="checked" />
                                <label for="filled-in-box">Remember me?</label>
                            </p>
                                <div class="form-group">
                                    <div class="col-xs-offset-3 col-xs-10">
                                        <button type="submit" name="submit" class="btn btn-primary">Log in</button>
                                    </div>
                                </div>
                        </form>
                    </div><!--/sign up form-->
                <br/>
                <br/>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>