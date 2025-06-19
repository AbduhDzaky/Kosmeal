<?php
date_default_timezone_set('Asia/Jakarta');

spl_autoload_register(function ($class) {
    if (file_exists("controller/$class.class.php")) {
        require_once "controller/$class.class.php";
    } elseif (file_exists("model/$class.class.php")) {
        require_once "model/$class.class.php";
    } elseif (file_exists("model/$class.php")) {
        require_once "model/$class.php";
    } elseif (file_exists("model/$class.php")) {
        require_once "model/$class.php";
    }
});

$controllerName = $_GET['c'] ?? 'Home';
$methodName = $_GET['m'] ?? 'index';

$controllerFile = "controller/$controllerName.class.php";

if (!file_exists($controllerFile)) {
    $controllerName = 'Home';
    $controllerFile = "controller/Home.class.php";
}

require_once($controllerFile);

$controller = new $controllerName();

if (method_exists($controller, $methodName)) {
    $controller->$methodName();
} else {
    echo "Method <strong>$methodName()</strong> tidak ditemukan di controller <strong>$controllerName</strong>.";
}
