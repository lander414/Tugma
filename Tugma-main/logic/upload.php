<?php
session_start();
echo$_SESSION["userid"];
?>

<form action="uploadpp.php" method="post" enctype="multipart/form-data">
  <p>Profile photo</p>
  <input type="file" name="file">
  <button type="submit" name="submit">upload</button>
</form>

<form action="uploadbg.php" method="post" enctype="multipart/form-data">
  <p>Background photo</p>
  <input type="file" name="file">
  <button type="submit" name="submit">upload</button>
</form>


