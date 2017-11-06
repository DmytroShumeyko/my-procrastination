<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Tasker</title>
        <link href="/template/css/bootstrap.min.css" rel="stylesheet">
        <link href="/template/css/font-awesome.min.css" rel="stylesheet">
        <link href="/template/css/animate.css" rel="stylesheet">
        <link href="/template/css/materialize.min.css" rel="stylesheet">
        <link href="/template/css/main.css" rel="stylesheet">


        <link rel="stylesheet" href="/template/css/bootstrap-datetimepicker.min.css" />
    </head><!--/head-->

    <body>


            <header id="header"><!--header-->
                <div class="header_top"><!--header_top-->
                    <div class="container">
<p class="center"><a href="/"><i class="fa fa-users"></i> Stop Procrastinate</a></p>
                    </div>
                </div>

                <div class="header-middle"><!--header-middle-->
                    <div class="container">
                        <div class="row">
                                <div class="shop-menu pull-right">
                                    <ul class="nav navbar-nav">
                                        <?php if (User::isGuest()): ?>
                                            <li><a href="/user/login/"><i class="fa fa-lock"></i> Log in</a></li>
                                            <li><a href="/user/register/"><i class="fa fa-registered"></i> Register</a></li>
                                        <?php else: ?>
                                            <li><a href="/cabinet/"><i class="fa fa-calendar"></i> Daily</a></li>
                                            <li><a href="/cabinet/tasks"><i class="fa fa-tasks"></i> Tasks</a></li>
                                            <li><a href="/user/logout/"><i class="fa fa-unlock"></i> Log out</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                        </div>
                    </div>
                </div><!--/header-middle-->



            </header><!--/header-->
