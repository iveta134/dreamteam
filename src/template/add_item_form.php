<?php
if (isset($_SESSION['id'])) {
    ?>
<form action="index.php" method="post" enctype="multipart/form-data">

<label for="firm">Firm</label>
<input type="text" name="firm">
<label for="item">Item</label>
<input type="text" name="item">
<label for="description">Description</label>
<input type="text" name="description">
<label for="size">Size</label>
<input type="text" name="size">
<label for="price">Price</label>
<input type="text" name="price">
<label for="currency">Currency</label>
<input type="text" name="currency">
<input type="file" name="fileToUpload" id="fileToUpload">
<button type="submit" name="addBtn">SUBMIT</button>
</form>
<?php
}
?>