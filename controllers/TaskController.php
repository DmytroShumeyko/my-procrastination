<?php


class TaskController
{

    /**
     * Action для страницы просмотра
     */
    public function actionIndex($id)
    {

        // Получаем идентификатор пользователя из сессии
        $userId = User::checkLogged();

        // Получаем информацию о пользователе из БД
        $user = User::getUserById($userId);
        if (!empty($user)) {
            $task = Task::getTasksById($id);
        } else {
            header("Location: /");
        }

        // Подключаем вид
        require_once(ROOT . '/views/task/index.php');
        return true;
    }


    /**
     * Action для страницы "Редактировать"
     */
    public function actionUpdate($id)
    {
        // Проверка доступа
        //   self::checkAdmin();
        User::checkLogged();
        User::isMyTask($id);

        $task = Task::getTasksById($id);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования. При необходимости можно валидировать значения
            $options['task_name'] = $_POST['task_name'];
            $options['description'] = $_POST['description'];


            // Сохраняем изменения
            Task::updateTaskById($id, $options);


            // Перенаправляем пользователя
            header("Location: /cabinet/tasks");
        }

        // Подключаем вид
        require_once(ROOT . '/views/task/update.php');
        return true;
    }
    public function actionUpdateDeal($id)
    {
        // Проверка доступа
        User::checkLogged();
        User::isMyDeal($id);

        $deal = Task::getDealById($id);


        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена

            // Получаем данные из формы редактирования. При необходимости можно валидировать значения
            $options['name'] = $_POST['name'];
            $options['description'] = $_POST['description'];
            $options['why_not'] = $_POST['why_not'];
            $options['result'] = $_POST['result'];


            // Сохраняем изменения
            Task::updateDealById($id, $options);


            // Перенаправляем пользователя
            header("Location: /cabinet/task");
        }

        // Подключаем вид
        require_once(ROOT . '/views/deals/updateDeal.php');
        return true;
    }
    public function actionUpdateDate($id)
    {
        // Проверка доступа
        //   self::checkAdmin();
        User::checkLogged();
        User::isMyDate($id);
        $date = Task::getDateById($id);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования. При необходимости можно валидировать значения
            $options['score'] = $_POST['score'];

            // Сохраняем изменения
            Task::updateDateById($id, $options);


            // Перенаправляем пользователя
            header("Location: /cabinet/index");
        }

        // Подключаем вид
        require_once(ROOT . '/views/dates/updateDate.php');
        return true;
    }

    public function actionUpdatetask()
    {
        // Проверка доступа
        User::checkLogged();


        // Обработка формы
        if (isset($_POST['id'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования. При необходимости можно валидировать значения
            $complete = $_POST['complete'];
            $id = $_POST['id'];
            User::isMyTask($id);
            // Сохраняем изменения
            Task::updateTaskByIdComplete($id, $complete);

            return 'success';
        }

    return true;
}
    public function actionUpdateDealStatus()
    {
        // Проверка доступа
        User::checkLogged();

        // Обработка формы
        if (isset($_POST['id'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования. При необходимости можно валидировать значения
            $complete = $_POST['complete'];
            $id = $_POST['id'];
            User::isMyDeal($id);
            // Сохраняем изменения
            Task::updateDealByIdComplete($id, $complete);
        }

        return true;
    }


    /**
     * Action для страницы "Удалить"
     */
    public function actionDelete($id)
    {
        // Проверка доступа
        User::checkLogged();
        User::isMyTask($id);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем
            Task::deleteTaskById($id);

            // Перенаправляем пользователя
            header("Location: /cabinet/tasks");
        }

        // Подключаем вид
        require_once(ROOT . '/views/task/delete.php');
        return true;
    }
    public function actionDeleteDeal($id)
    {
        // Проверка доступа
        User::checkLogged();
        User::isMyDeal($id);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем
            Task::deleteDealById($id);

            // Перенаправляем пользователя
            header("Location: /cabinet/index");
        }

        // Подключаем вид
        require_once(ROOT . '/views/deals/delete.php');
        return true;
    }
    public function actionDeleteDate($id)
    {
        // Проверка доступа
        User::checkLogged();
        User::isMyDate($id);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем
            Task::deleteDateById($id);

            // Перенаправляем пользователя
            header("Location: /cabinet/index");
        }

        // Подключаем вид
        require_once(ROOT . '/views/deals/delete.php');
        return true;
    }

}
