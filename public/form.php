<?php

echo '<form action="form.php" method="get">';
echo "<input type=' date'  name=' mydate'  id=' '  value=' 2020-02-20' >";
if (isset($_GET['mynumber'])) {
    $mynumber = $_GET['mynumber'];
    echo "<input type='number' name='mynumber' id='' value='$mynumber'>";
}
?>
    <input type="text" name="mytext" id="" value="Valdis">
    <button type="submit">SUBMIT</button>
</form>

<?php
if (isset($_GET['mydate'])) {
    echo "Your date is:" . $_GET['mydate'] . "<br>";
}

if (isset($_GET['mytext'])) {
    echo "Your date is:" . $_GET['mytext'] . "<br>";
}