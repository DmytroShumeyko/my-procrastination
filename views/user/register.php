<?php include ROOT . '/views/layouts/header.php'; ?>

    <section class="main">
        <div class="container">
            <div class="row">

                <div class="container">

                    <?php if ($result): ?>
                        <p>Success!</p>
                    <?php else: ?>
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <ul class="errorlist">
                            <?php foreach ($errors as $error): ?>
                                <li> - <?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <div class="signup-form"><!--sign up form-->
                        <h2>Register</h2>
                        <form method="post" action="">
                            <div class="input-field">
                                <input type="text" class="form-control" id="firstName" name="name"
                                       value="<?php echo $name; ?>">
                                <label for="firstName">Name</label>
                            </div>
                            <div class="input-field">
                                <input type="password" class="form-control" id="inputPassword" name="password"
                                       value="<?php echo $password; ?>">
                                <label for="inputPassword">Password</label>
                            </div>
                            <div class="input-field">
                                <input type="password" class="form-control" id="confirmPassword" name="passwordRepeat">
                                <label for="confirmPassword">Confirm password</label>
                            </div>
                    </div>
                    <img src="" id='capcha-image'>
                    <a href="#" onclick="$('#capcha-image').attr('src', '/user/output');return false;" id="new">Update
                        image</a>

                    <div class="input-field">
                        <input class="form-control" type="text" name="сaptcha" class=" form-control" id="capcha">
                        <label for="capcha">Enter the code from the image</label>
                    </div>
                </div>
                <br/>
                <div class="form-group">
                    <div class="container textcenter">
                        <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                    </div>
                </div>
                </form>
            </div><!--/sign up form-->

            <?php endif; ?>
            <br/>
            <br/>
        </div>
        </div>
        </div>
    </section>

<?php include ROOT . '/views/layouts/footer.php'; ?>