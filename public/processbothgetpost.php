<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    require '../src/template/form_template.php';
    echo var_dump($_GET);
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "Processing POST";
    var_dump($_POST);
} else {
    echo "Sorry I do not know how to process" . $_SERVER['REQUEST_METHOD'];
}