<style>
  
  form {
  max-width: 400px;
  margin: 20px auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  overflow: hidden;
}

.file-input-container {
  position: relative;
  overflow: hidden;
  margin-bottom: 10px;
}

.file-input {
  font-size: 16px;
  color: #333;
  padding: 10px;
}

.file-btn {
  background-color: gray;
  color: #fff;
  padding: 10px 15px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.file-btn:hover {
  background-color: #333;
}

textarea {
  width: 100%;
  padding: 10px;
  margin-bottom: 10px;
  box-sizing: border-box;
}

button {
  background-color: #4caf50;
  color: #fff;
  padding: 10px 15px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

button:hover {
  background-color: #45a049;
}

p {
  font-weight: bold;
  margin-bottom: 10px;
}
</style>

<link rel="stylesheet" href="../style/edit.css?v=<?php echo time(); ?>">
<?php
include("../path/header.php"); 

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["bio"])) {
  // Attempt to update the bio
  if (UpdateBioByUserId($_POST["bio"], $_SESSION["userid"])) {
      // Display success message using JavaScript
      echo '<script>alert("Bio updated successfully!");</script>';
  } 
}


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["bio"])) {
  UpdateBioByUserId($_POST["bio"], $_SESSION["userid"]);
}

?>

<form action="../logic/uploadpp.php" method="post" enctype="multipart/form-data">
  <p>Profile photo</p>
  <input class="file-btn" type="file" name="file">
  <button type="submit" name="submit">upload</button>
</form>


<form action="../logic/uploadbg.php" method="post" enctype="multipart/form-data">
  <p>Background photo</p>
  <input class="file-btn" type="file" name="file">
  <button type="submit" name="submit">upload</button>
</form>

<form class="" action="upload.php" method="post">
      <textarea name="bio" placeholder="Bio:" cols="50" rows="5" spellcheck="false"></textarea>
      <button class="settings-button" type="submit">Bio Update</button>
</form> 


<form action="../logic/Video_Upload.php" method="post" enctype="multipart/form-data">
  <p>Video Reels</p>
  <input class="file-btn" type="file" name="file">
  <button type="submit" name="submit">Upload video</button>
</form>
<?php

include("../path/footer.php"); 
