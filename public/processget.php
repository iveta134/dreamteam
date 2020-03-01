<form action="processget.php" method="get">
    <input name="myname"></input>
    <button type="submit">GET</button>

</form>
<form action="processpost.php" method="post">
    <input name="mysecondname"></input>
    <button type="submit">POST</button>

</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    echo "Processing GET: ";
    var_dump($_GET);
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "Processing POST";
    var_dump($_POST);
} else {
    echo "Sorry I do not know how to process" . $_SERVER['REQUEST_METHOD'];
}