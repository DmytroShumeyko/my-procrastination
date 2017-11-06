<?php

// FRONT CONTROLLER

// Общие настройки
ini_set('display_errors',0);
error_reporting(E_ALL);

session_start();
// Подключение файлов системы
define('ROOT', dirname(__FILE__));
define('img_dir', ROOT.'/template/images/captcha/background/');
define('font_dir',ROOT.'/template/images/captcha/font/verdana.ttf');
require_once(ROOT.'/components/Autoload.php');


// Вызов Router
$router = new Router();
$router->run();