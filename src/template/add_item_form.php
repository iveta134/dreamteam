<?php
if (isset($_SESSION['id'])) {
    ?>
<form action="index.php" method="post" enctype="multipart/form-data">

<label for="songname">Song</label>
<input type="text" name="songname">
<label for="artist">Artist</label>
<input type="text" name="artist">
<label for="album">Album</label>
<input type="text" name="album">
<label for="songlen">Duration</label>
<input type="text" name="songlen">
<input type="file" name="fileToUpload" id="fileToUpload">
<button type="submit" name="addBtn">SUBMIT</button>
</form>
<?php
}
?>