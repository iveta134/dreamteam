<?php
session_start();
session_unset();
setcookie("uid", "", time() - 3600);
// $_SESSION['id'] = null;
// $_SESSION['user'] = null;
header('Location: /');