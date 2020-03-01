<?php
session_start();
require_once "../config/config.php";
require_once "../src/classes/Model.php";
require_once "../src/classes/View.php";
require_once "../src/classes/Controller.php";

$view = new View();
$model = new Model($config, $view);
$controller = new Controller($model);
// $controller->route();  //TODO add real route later
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // var_dump($_POST);
    // var_dump($_POST);
    // die("for now");
    $hash = $model->getHash($_POST['username']);
    if (password_verify($_POST['pw'], $hash)) {
        // echo "You are good to go! consider yourself logged in ";
        $_SESSION['user'] = $_POST['username'];
        $_SESSION['id'] = $model->getId($_POST['username']);
        //https://www.w3schools.com/php/func_network_setcookie.asp
        $cookie_name = "uid";
        $cookie_value = $_SESSION['id'];
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
        header('Location: /');
    } else {
        //we could consider adding a specific message about login status
        header('Location: /?badlogin=true');
    }
    //select name and hash from DB
    //password_verify user entry against the hash
}