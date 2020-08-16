<?php
session_start();

use Application\Core\Router;
use Application\Lib\Date;

spl_autoload_register(function ($class) {
    $ds = DIRECTORY_SEPARATOR;
    $path = $_SERVER['DOCUMENT_ROOT'] . $ds . str_replace('\\', $ds, $class) . '.php';
    if (file_exists($path)) {
        include $path;
    }
});

include_once 'application/php/phpFunction.php';

if (!isset($_SESSION['time'])) {
    $path = $_SERVER['DOCUMENT_ROOT'] .DIRECTORY_SEPARATOR. 'public';
    $arrDir = array_diff(scandir($path), ['.', '..']);
    foreach ($arrDir as $dir) {
        $time = date_create(date('Y-m-d', filemtime('public/' . $dir)));
        if ((new Date($time->getTimestamp()))->dateDiffDay() >= 7) {
            rmRec($path . DIRECTORY_SEPARATOR . $dir);
        }
    }
    $_SESSION['time'] = time();
}

$router = new Router();
$router->run();






