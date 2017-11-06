<?php

class DirectorController
{

    public function actionCreateTask()
    {
        User::checkLogged();
        $userId = User::checkLogged();
        $result = '';

        if (isset($_POST['submit'])) {
            $task['task_name'] = $_POST['task_name'];
            $task['description'] = $_POST['description'];

            $errors = false;

            if (!isset($task['task_name']) || empty($task['task_name'])) {
                $errors[] = 'Заполните поля';
            }

            //замена возможной пустой строки на null
            if (empty($task['description'])) {
                $task['description'] = null;
            }

            if ($errors == false) {
                if (Task::addTask($userId,$task)) {
                    $result = 'Задание добавлено!';
                    header("Location: /cabinet/tasks");
                } else {
                    $result = 'Ошибка в добавлении данных';
                }
            }
        }

        require_once(ROOT . '/views/director/add_form.php');
        return true;
    }
    public function actionCreateDeal()
    {
        User::checkLogged();
        $userId = User::checkLogged();
        $result = '';

        if (isset($_POST['submit'])) {
            $task['name'] = $_POST['name'];
            $task['description'] = $_POST['description'];
            $today_date_id = Task::getDateByDate($userId);
            $today_date_id = $today_date_id['id'];
            $errors = false;

            if (!isset($task['name']) || empty($task['name'])) {
                $errors[] = 'Заполните поля';
            }

            //замена возможной пустой строки на null
            if (empty($task['description'])) {
                $task['description'] = null;
            }

            if ($errors == false) {
                if (Task::addDeal($userId,$task,$today_date_id)) {
                    $result = 'Задание добавлено!';
                    header("Location: /cabinet/index");
                } else {
                    $result = 'Ошибка в добавлении данных';
                }
            }
        }

        require_once(ROOT . '/views/director/add_deal.php');
        return true;
    }
}