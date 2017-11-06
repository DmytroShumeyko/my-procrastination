<?php include ROOT . '/views/layouts/header.php'; ?>

    <section>
        <div class="container-my">
            <div class="row">
                <h4><?php echo $user['name']; ?>'s cabinet</h4>

                    <div class="row">
                        <a class="btn btn-default back" href="/cabinet/edit">Edit user's data</a>
                    </div>


                    <div class="row">
                        <a href="/director/create_deal" class="btn btn-default back"><i class="fa fa-plus"></i> Create task</a>
                    </div>

            </div>
            <div class="row">
                <table class="table table-bordered table-responsive striped">
                    <thead>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Placed</th>
                    <th>Completed at</th>
                    <th>Why not</th>
                    <th>Is complete</th>
                    <th>Deal score</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>Day's score</th>
                    </thead>
                    <tbody>
                    <?php if (!empty($user_dates)): ?>
                        <?php if (!empty($deals)): ?>
                            <?php foreach ($user_dates as $date): ?>
                                <?php foreach ($deals as $deal): ?>
                                    <?php if ($date['id'] == $deal['user_dates_id']): ?>
                                    <tr>
                                        <td><?= $date['user_date'] ?></td>
                                        <td><?= $deal['name'] ?></td>
                                        <td><?= $deal['description'] ?></td>
                                        <td><?= $deal['placed'] ?></td>
                                        <td><?= $deal['deadline'] ?></td>
                                        <td><?= $deal['why_not'] ?></td>
                                        <td><input type="checkbox" name="dealBox" data-id="<?php echo $deal['id']; ?>"
                                                   id="<?php echo $deal['id']; ?>" <?php if ($deal['complete'] == 1) echo ' checked="checked"'; ?> />
                                            <label for="<?php echo $deal['id']; ?>"></label>
                                        </td>
                                        <td><?= $deal['result'] ?></td>
                                        <td><a href="/task/update_deal/<?php echo $deal['id']; ?>" title="Редактировать"><i
                                                        class="fa fa-pencil-square-o"></i></a>
                                        </th></td>
                                        <td><a href="/task/delete_deal/<?php echo $deal['id']; ?>" title="Удалить"><i
                                                        class="fa fa-times"></i></a></td>
                                        <td>-</td>
                                    </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <tr>
                                    <td><?= $date['user_date'] ?></td>
                                    <td colspan="7"></td>
                                    <td><a href="/task/update_date/<?php echo $date['id']; ?>" title="Редактировать"><i
                                                    class="fa fa-pencil-square-o"></i></a>
                                    </th></td>
                                    <td><a href="/task/delete_date/<?php echo $date['id']; ?>" title="Удалить"><i
                                                    class="fa fa-times"></i></a></td>
                                    <td><?= $date['score'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

<?php include ROOT . '/views/layouts/footer.php'; ?>