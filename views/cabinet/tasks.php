<?php include ROOT . '/views/layouts/header.php'; ?>

    <section>
        <div class="container">
            <div class="row">
                <h4><?php echo $user['name']; ?>'s cabinet</h4>
                <a class="btn btn-default back" href="/cabinet/edit">Edit user's data</a>
            </div>
            <div class="row">
                <a href="/director/create_task" class="btn btn-default back"><i class="fa fa-plus"></i> Create task</a>
            </div>
            <table class="table table-bordered table-responsive striped">
                <thead>
                <tr>
                    <th>Task name</th>
                    <th>Description</th>
                    <th>Placed</th>
                    <th>Completed at</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                <?php if ($_SESSION['role'] == 2): ?>
                    <?php if (!empty($userTasks)): ?>
                        <?php foreach ($userTasks as $task): ?>
                            <tr>
                                <td><a href="/task/index/<?php echo $task['id_task']; ?>"
                                       title="Просмотр задания"><?= $task['task_name'] ?></a></td>
                                <td><?= $task['description'] ?></td>
                                <td><?= $task['placed'] ?></td>
                                <td><?= $task['deadline'] ?></td>
                                <td><input type="checkbox" name="taskBox" data-id="<?php echo $task['id_task']; ?>"
                                           id="<?php echo $task['id_task']; ?>" <?php if ($task['complete'] == 1) echo ' checked="checked"'; ?> />
                                    <label for="<?php echo $task['id_task']; ?>"></label>
                                </td>
                                <td><a href="/task/update/<?php echo $task['id_task']; ?>" title="Редактировать"><i
                                                class="fa fa-pencil-square-o"></i></a></td>
                                <td><a href="/task/delete/<?php echo $task['id_task']; ?>" title="Удалить"><i
                                                class="fa fa-times"></i></a></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <th colspan="7"><p>Nothing TODO!</p></th>
                        </tr>
                    <?php endif; ?>
                <?php endif; ?>

                </tbody>
            </table>
        </div>
    </section>

<?php include ROOT . '/views/layouts/footer.php'; ?>