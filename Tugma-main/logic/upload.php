<?php
session_start();
echo$_SESSION["userid"];
include("query.php");


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["bio"])) {
  UpdateBioByUserId($_POST["bio"], $_SESSION["userid"]);
}

?>



<form class="" action="upload.php" method="post">
      <textarea name="bio" placeholder="Bio:" cols="50" rows="5" spellcheck="false"></textarea>
      <button class="settings-button" type="submit">Bio Update</button>
</form>




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


<form action="Video_Upload.php" method="post" enctype="multipart/form-data">
  <p>Video Reels</p>
  <input type="file" name="file">
  <button type="submit" name="submit">Upload video</button>
</form>
