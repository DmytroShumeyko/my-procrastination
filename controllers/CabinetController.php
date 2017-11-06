<?php

/**
 * Контроллер CabinetController
 * Кабинет пользователя
 */
class CabinetController
{

    /**
     * Action для страницы "Кабинет пользователя"
     */
    public function actionIndex()
    {
        // Получаем идентификатор пользователя из сессии
        $userId = User::checkLogged();


        $dates = Task::getDates($userId);
        if (!empty($dates)) {
            $check_date = [];
            foreach ($dates as $date) {
                if ($date['user_date'] == date("Y-m-d")) {
                    $check_date[0] = $date['user_date'];
                }
            }
            if (empty($check_date)) {

                Task::addDate($userId);

                $today_date_id = Task::getDateByDate($userId);
                $today_date_id = $today_date_id['id'];

                $yesterday_id = Task::getYesterdayDate($userId);
                $yesterday_id = $yesterday_id[1]['id'];

                $yesterday_deals = Task::getDealsByDate($userId, $yesterday_id,$today_date_id);

                Task::addDealNowDay($yesterday_deals);

            }
        } else {
            Task::addDate($userId);
        }


        // Получаем информацию о пользователе из БД
        $user = User::getUserById($userId);
        $deals = Task::getDeals($userId);
        $user_dates = Task::getDates($userId);

        // Подключаем вид
        require_once(ROOT . '/views/cabinet/index.php');
        return true;
    }

    /**
     * Action для страницы "Редактирование данных пользователя"
     */
    public function actionEdit()
    {
        // Получаем идентификатор пользователя из сессии
        $userId = User::checkLogged();

        // Получаем информацию о пользователе из БД
        $user = User::getUserById($userId);

        // Заполняем переменные для полей формы
        $name = $user['name'];
        $password = $user['password'];

        // Флаг результата
        $result = false;

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования
            $name = $_POST['name'];
            $password = $_POST['password'];

            // Флаг ошибок
            $errors = false;

            // Валидируем значения
            if (!User::checkName($name)) {
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }

            if ($errors == false) {
                // Если ошибок нет, сохраняет изменения профиля
                $result = User::edit($userId, $name, $password);

            }
        }

        // Подключаем вид
        require_once(ROOT . '/views/cabinet/edit.php');
        return true;
    }

    /**
     * Action для страницы "Кабинет пользователя"
     */
    public function actionTasks()
    {
        // Получаем идентификатор пользователя из сессии
        $userId = User::checkLogged();

        // Получаем информацию о пользователе из БД
        $user = User::getUserById($userId);
        $tasks = Task::getTasks();
        $userTasks = Task::getTasksByUser($userId);
        $users = User::users();

        // Подключаем вид
        require_once(ROOT . '/views/cabinet/tasks.php');
        return true;
    }

}
