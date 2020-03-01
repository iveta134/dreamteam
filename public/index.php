<?php
session_start();
require_once "../config/monolog.php";
require_once "../config/config.php";

require_once "../src/classes/Model.php";
require_once "../src/classes/View.php";
require_once "../src/classes/Controller.php";

$view = new View();
$model = new Model($config, $view); //here model constructer will have created DB connection
$controller = new Controller($model);
$controller->route();
// $model->getSongs();
// $view->printSongs([[
//     'id' => 66,
//     'mysongsss' => 'Waterloo',
//     'artistii' => 'Abba'],
//     [
//         'id' => 776,
//         'mysong' => 'Waterloo',
//         'artist' => 'Abbass']]);

//we can get static constant directly from our class blueprints
// echo "My model: " . Model::MODELNAME . "<hr>";