<?php

class Task
{

    public static function getTasks()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT * FROM task ORDER BY id_task ASC');
        $tasks = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $tasks[$i]['id_task'] = $row['id_task'];
            $tasks[$i]['task_name'] = $row['task_name'];
            $tasks[$i]['description'] = $row['description'];
            $tasks[$i]['user_id'] = $row['user_id'];
            $tasks[$i]['placed'] = $row['placed'];
            $tasks[$i]['deadline'] = $row['deadline'];
            $tasks[$i]['complete'] = $row['complete'];
            $i++;

        }
        return $tasks;
    }

    public static function getTasksByUser($userid)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $sql = 'SELECT * FROM task WHERE user_id = :userid ORDER BY id_task ASC';
        $result = $db->prepare($sql);
        $result->bindParam(':userid', $userid, PDO::PARAM_INT);
        $result->execute();

        $userTasks = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $userTasks[$i]['id_task'] = $row['id_task'];
            $userTasks[$i]['task_name'] = $row['task_name'];
            $userTasks[$i]['description'] = $row['description'];
            $userTasks[$i]['deadline'] = $row['deadline'];
            $userTasks[$i]['placed'] = $row['placed'];
            $userTasks[$i]['complete'] = $row['complete'];
            $i++;

        }
        return $userTasks;
    }

    public static function getTasksById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $sql = 'SELECT * FROM task WHERE id_task = :id_task';
        $result = $db->prepare($sql);
        $result->bindParam(':id_task', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();

        // Получение и возврат результатов
        return $result->fetch();
    }


    public static function deleteTaskById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM task WHERE id_task = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function updateTaskById($id, $options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE task
            SET 
                task_name = :task_name, 
                description = :description 

                
            WHERE id_task = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':task_name', $options['task_name'], PDO::PARAM_STR);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);


        return $result->execute();
    }


    public static function updateTaskByIdComplete($id, $complete)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE task
            SET 
                complete = :complete,
                deadline = :deadline
            WHERE id_task = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':complete', $complete, PDO::PARAM_INT);
        if ($complete == 1){
            $result->bindParam(':deadline', date("Y-m-d h:i:s"), PDO::PARAM_STR);
        }else{
            $date = null;
            $result->bindParam(':deadline', $date, PDO::PARAM_NULL);
        }


        return $result->execute();
    }


    public static function addTask($userId, $task)
    {
        $db = Db::getConnection();

        $sql = 'INSERT INTO `task` (`task_name`, `description`, `user_id`, `placed`) '
            . 'VALUES (:task_name, :description, :user_id, :placed)';
        $result = $db->prepare($sql);

        $result->bindParam(':task_name', $task['task_name'], PDO::PARAM_STR);
        $result->bindParam(':description', $task['description'], PDO::PARAM_STR);
        $result->bindParam(':user_id', $userId, PDO::PARAM_STR);
        $result->bindParam(':placed', date("Y-m-d h:i:s"), PDO::PARAM_STR);

        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public static function updateTaskByIdDev($id, $id_task)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE task
            SET 
                user_id = :user_id
                
            WHERE id_task = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $id, PDO::PARAM_INT);
        $result->bindParam(':id', $id_task, PDO::PARAM_INT);
        return $result->execute();

    }

    /*
     * Deals
     */

    public static function getDeals($user_id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $sql = 'SELECT * FROM deals WHERE user_id = :user_id ORDER BY placed ASC';
        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $result->execute();
        $tasks = [];
        $i = 0;
        while ($row = $result->fetch()) {
            $tasks[$i]['id'] = $row['id'];
            $tasks[$i]['name'] = $row['name'];
            $tasks[$i]['description'] = $row['description'];
            $tasks[$i]['user_id'] = $row['user_id'];
            $tasks[$i]['user_dates_id'] = $row['user_dates_id'];
            $tasks[$i]['placed'] = $row['placed'];
            $tasks[$i]['deadline'] = $row['deadline'];
            $tasks[$i]['complete'] = $row['complete'];
            $tasks[$i]['why_not'] = $row['why_not'];
            $tasks[$i]['result'] = $row['result'];
            $i++;

        }
        return $tasks;
    }
    public static function getDealsByDate($user_id, $yesterday_id, $today_date_id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $sql = 'SELECT * FROM deals WHERE user_id = :user_id AND user_dates_id = :user_dates_id ORDER BY id DESC ';
        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $result->bindParam(':user_dates_id', $yesterday_id, PDO::PARAM_INT);
        $result->execute();
        $tasks = [];
        $i = 0;
        while ($row = $result->fetch()) {
            $tasks[$i]['name'] = $row['name'];
            $tasks[$i]['description'] = $row['description'];
            $tasks[$i]['user_id'] = $row['user_id'];
            $tasks[$i]['user_dates_id'] = $today_date_id;
            $tasks[$i]['placed'] = $row['placed'];
            $i++;

        }
        return $tasks;
    }

    public static function getDealById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $sql = 'SELECT * FROM deals WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();

        // Получение и возврат результатов
        return $result->fetch();
    }

    public static function addDeal($userId, $task,$today_date_id)
    {
        $db = Db::getConnection();

        $sql = 'INSERT INTO `deals` (`name`, `description`, `user_id`, `user_dates_id`, `placed`) '
            . 'VALUES (:name, :description, :user_id, :user_dates_id, :placed)';
        $result = $db->prepare($sql);

        $result->bindParam(':name', $task['name'], PDO::PARAM_STR);
        $result->bindParam(':description', $task['description'], PDO::PARAM_STR);
        $result->bindParam(':user_id', $userId, PDO::PARAM_STR);
        $result->bindParam(':user_dates_id', $today_date_id, PDO::PARAM_STR);
        $result->bindParam(':placed', date("Y-m-d h:i:s"), PDO::PARAM_STR);

        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public static function addDealNowDay($tasks)
    {
        $db = Db::getConnection();
        $valuesArray = [];
        foreach ($tasks as $key => $item) {
            $valuesArray[] = '(:name' . $key . ',:description' . $key . ',:user_id' . $key . ',:user_dates_id' . $key . ',:placed' . $key . ')';
        }
        $valuesForQuery = implode(',', $valuesArray);

        $sql = 'INSERT INTO `deals` (`name`, `description`, `user_id`, `user_dates_id`, `placed`) '
            . 'VALUES ' . $valuesForQuery;
        $result = $db->prepare($sql);


        foreach ($tasks as $key => $item) {
            $result->bindParam(':name' . $key, $item['name'], PDO::PARAM_STR);
            $result->bindParam(':description' . $key, $item['description'], PDO::PARAM_STR);
            $result->bindParam(':user_id' . $key, $item['user_id'], PDO::PARAM_INT);
            $result->bindParam(':user_dates_id' . $key, $item['user_dates_id'], PDO::PARAM_INT);
            $result->bindParam(':placed' . $key, $item['placed'], PDO::PARAM_STR);
        }

        if ($result->execute()) {
            return true;
        } else {
            return false;
        }

    }

    public static function updateDealById($id, $options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE deals
            SET 
                name = :name, 
                description = :description,
                why_not = :why_not,
                result = :result 

                
            WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':why_not', $options['why_not'], PDO::PARAM_STR);
        $result->bindParam(':result', $options['result'], PDO::PARAM_INT);


        return $result->execute();
    }

    public static function deleteDealById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM deals WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function updateDealByIdComplete($id, $complete)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE deals
            SET 
                complete = :complete,
                deadline = :deadline
            WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':complete', $complete, PDO::PARAM_INT);
        if ($complete == 1){
            $result->bindParam(':deadline', date("Y-m-d h:i:s"), PDO::PARAM_STR);
        }else{
            $date = null;
            $result->bindParam(':deadline', $date, PDO::PARAM_NULL);
        }

        return $result->execute();
    }

    /*
     * Dates
     */

    public static function addDate($userId)
    {
        $db = Db::getConnection();

        $sql = 'INSERT INTO `user_dates` ( `user_id`, `user_date`) '
            . 'VALUES (:user_id, :user_date)';
        $result = $db->prepare($sql);


        $result->bindParam(':user_id', $userId, PDO::PARAM_STR);
        $result->bindParam(':user_date', date("Y-m-d"), PDO::PARAM_STR);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        return $result->fetch();

    }

    public static function getDates($user_id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $sql = 'SELECT * FROM user_dates WHERE user_id = :user_id ORDER BY user_date DESC ';
        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $result->execute();

        $tasks = [];
        $i = 0;
        while ($row = $result->fetch()) {
            $tasks[$i]['id'] = $row['id'];
            $tasks[$i]['user_id'] = $row['user_id'];
            $tasks[$i]['user_date'] = $row['user_date'];
            $tasks[$i]['score'] = $row['score'];
            $i++;

        }
        return $tasks;
    }

    public static function getDateById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $sql = 'SELECT * FROM user_dates WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();

        // Получение и возврат результатов
        return $result->fetch();
    }

    public static function getDateByDate($user_id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $sql = 'SELECT * FROM user_dates WHERE user_id = :user_id AND user_date = :user_date';
        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $result->bindParam(':user_date', date("Y-m-d"), PDO::PARAM_STR);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();

        // Получение и возврат результатов
        return $result->fetch();
    }
    public static function getYesterdayDate($user_id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $sql = 'SELECT * FROM user_dates WHERE user_id = :user_id ORDER BY id DESC ';
        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();

        $tasks = [];
        $i = 0;
        while ($row = $result->fetch()) {
            $tasks[$i]['id'] = $row['id'];
            $tasks[$i]['user_id'] = $row['user_id'];
            $tasks[$i]['user_date'] = $row['user_date'];
            $tasks[$i]['score'] = $row['score'];
            $i++;

        }
        return $tasks;
    }

    public static function updateDateById($id, $options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE user_dates
            SET 
                score = :score 

            WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':score', $options['score'], PDO::PARAM_INT);

        return $result->execute();
    }

    public static function deleteDateById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM user_dates WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
}