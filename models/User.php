<?php

class User
{
    public static function users()
    {
        $db = Db::getConnection();
        $names = array();
        $result = $db->query("SELECT * FROM user");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $i = 0;
        while ($row = $result->fetch()) {
            $names[$i]['id'] = $row['id'];
            $names[$i]['name'] = $row['name'];
            $i++;
        }
        return  $names;

    }

    public static function register($name,$password,$role) {

        $db = Db::getConnection();
        $password = md5($password);

        $sql = 'INSERT INTO user (name, password, role)'
            . 'VALUES (:name, :password, :role)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->bindParam(':role', $role, PDO::PARAM_STR);


        return $result->execute();
    }
    /**
     * Проверяет имя: не меньше, чем 2 символа
     */
    public static function checkName($name) {
        if (strlen($name) >= 2) {
            return true;
        }
        return false;
    }
    /**
     * Проверяет имя: не меньше, чем 6 символов
     */
    public static function checkPassword($password) {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }
    /**
     * Проверяет капчу
     */
    public static function checkCaptcha()
    {
        if(isset($_POST['сaptcha'])){
            if ($_POST['сaptcha'] == $_SESSION['captcha'])
            {
                return true;
            }
            else {false;}
        }
        return false;
    }
    public static function checkNameExists($name){
        $db = Db::getConnection();

        $sql = 'SELECT COUNT(*) FROM user WHERE name = :name';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->execute();
        $count=$result->fetchColumn();
        return $count;
    }

    public static function checkPasswordRepeat($password,$passwordRepeat) {
        if ($password == $passwordRepeat) {
            return true;
        }
        return false;
    }


    public static function checkUserData($name,$password) {

        $db = Db::getConnection();

        $sql = 'SELECT * FROM user WHERE name = :name AND password = :password';
        $password = md5($password);
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();
        $user =  $result->fetch();

        if($user) {

            return $user;
        }
        return false;
    }

    public static function auth($user) {

        $_SESSION['user'] = $user['id'];
        $_SESSION['role'] = $user['role'];

    }
    public static function checkLogged(){
        if(isset($_SESSION['user']))
        {
            return $_SESSION['user'];
        }
        header("Location:/user/login");
    }
    public static function isGuest(){

        if(isset($_SESSION['user']))
        {
            return false;
        }
        return true;
    }
    public static function getUserById($id)
    {
        if ($id) {
            $db = Db::getConnection();
            $sql = 'SELECT * FROM user WHERE id = :id';
            $result = $db->prepare($sql);
            $result -> bindParam(':id',$id, PDO::PARAM_INT);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result-> execute();
            return $result->fetch();
        }
    }

    public static function edit($id,$name,$password)
    {
        $db = Db::getConnection();
        $password = md5($password);

        $sql = "UPDATE user SET name = :name, password = :password WHERE id = :id";
        $result = $db->prepare($sql);
        $result -> bindParam(':name',$name, PDO::PARAM_STR);
        $result -> bindParam(':password',$password, PDO::PARAM_STR);
        $result -> bindParam(':id',$id, PDO::PARAM_INT);         //$result->setFetchMode(PDO::FETCH_ASSOC);
        return $result-> execute();
    }
    public static function generateImage($code)
    {

        header("Content-Type:image/png");
        $linenum = rand(3, 7);
        $img_arr = array("1.png","2.png","3.png");
        $font_size = rand(20, 30);
        $img_fn = $img_arr[rand(0, sizeof($img_arr)-1)];
        $im = imagecreatefrompng (img_dir . $img_fn);
        for ($i=0; $i<$linenum; $i++)
        {
            $color = imagecolorallocate($im, rand(0, 150), rand(0, 100), rand(0, 150));
            imageline($im, rand(0, 20), rand(1, 50), rand(150, 180), rand(1, 50), $color);
        }
        $color = imagecolorallocate($im, rand(0, 200), 0, rand(0, 200));
        $x = rand(0, 35);

        for($i = 0; $i < strlen($code); $i++) {
            $x+=15;
            $letter=substr($code, $i, 1);
            imagettftext ($im, $font_size, rand(2, 4), $x, rand(50, 55), $color, font_dir, $letter);
        }

        for ($i=0; $i<$linenum; $i++)
        {
            $color = imagecolorallocate($im, rand(0, 255), rand(0, 200), rand(0, 255));
            imageline($im, rand(0, 20), rand(1, 50), rand(150, 180), rand(1, 50), $color);
        }
        ImagePNG ($im);
        ImageDestroy ($im);
    }


    public static function generateCode()
    {
        $chars = 'abdefhknrstyz23456789';
        $length = rand(4, 7);
        $numChars = strlen($chars);
        $str = '';
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, rand(1, $numChars) - 1, 1);
        }
        return $str;
    }

    public static function isMyDeal($id)
    {
        $userId = User::checkLogged();
        $deal = Task::getDealById($id);

        if ($userId == $deal['user_id']) {
            return true;
        }
        die('Access denied');
    }
    public static function isMyTask($id)
    {
        $userId = User::checkLogged();
        $task = Task::getTasksById($id);

        if ($userId == $task['user_id']) {
            return true;
        }
        die('Access denied');
    }    public static function isMyDate($id)
    {
        $userId = User::checkLogged();
        $date = Task::getDateById($id);

        if ($userId == $date['user_id']) {
            return true;
        }
        die('Access denied');
    }

    public static function checkTeamlead()
    {
        // Проверяем авторизирован ли пользователь. Если нет, он будет переадресован
        $userId = User::checkLogged();

        // Получаем информацию о текущем пользователе
        $user = User::getUserById($userId);

        // Если роль текущего пользователя пускаем его
        if ($user['role'] == '1' || $user['role'] == '0') {
            return true;
        }

        // Иначе завершаем работу с сообщением об закрытом доступе
        die('Access denied');
    }
}