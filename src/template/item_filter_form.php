<?php
if (isset($_SESSION['id'])) {
    ?>
<form action="index.php" method="get">

<label for="itemname">Song Like</label>
<input type="text" name="itemname"
value="<?php echo $filterValue ?>"
>
<button type="submit">SUBMIT</button>
</form>
<?php
}
?>