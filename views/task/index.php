<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 padding-right">
                <div class="product-details"><!--product-details-->
                    <div class="row">

                            <div class="product-information"><!--/product-information-->

                                <h2><?php echo $task['task_name']; ?></h2>
                                <p><b>Task Id:</b> <?php echo $task['id_task']; ?></p>
                                <p><b>Placed: </b><?php echo $task['placed']; ?></p>
                                <p><b>Completed at: </b><?php echo $task['deadline']; ?></p>
                                <p><b>Status: </b>
                                    <?php if ($task['complete']==1) echo 'Complete'; else echo 'Working'; ?>
                                </p>

                            </div><!--/product-information-->

                    </div>
                    <div class="row">                                
                        <div class="col-sm-12">
                            <br/>
                            <h5>Task description</h5>
                            <?php echo $task['description']; ?>
                        </div>
                    </div>
                </div><!--/product-details-->

            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>