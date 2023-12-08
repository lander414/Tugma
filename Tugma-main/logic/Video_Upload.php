 <?php
include("../db/database.php");
include("query.php");
session_start();
  $fileName = $_FILES["file"]["name"];
  $filetmpName = $_FILES["file"]["tmp_name"];
  $fileSize = $_FILES["file"]["size"];
  $fileType = $_FILES["file"]["type"];
  $fileError = $_FILES["file"]["error"];

$fileExt = explode(".",$fileName);
$fileExt2 = strtolower(end($fileExt));
if($fileError == 0 && $fileSize < 10000000){
 
  switch ($fileExt2){
    case "mp3":
    case "mp4":
    case "flv":
      $updateFileName = $_SESSION["userid"].".".$fileExt2;
      $fileDIR  = "../videos/".$updateFileName;
     UpdateVideo($_SESSION["userid"],$fileExt2);
      move_uploaded_file($filetmpName,$fileDIR);
      // Display success message using JavaScript
      echo '<script>alert("Video Reel uploaded successfully!");</script>';
      break;
  default:
      // Display error message using JavaScript
      echo '<script>alert("Error: File type doesn\'t match allowed extension!");</script>';
      break;
}
} else {
// Display generic error message using JavaScript
echo '<script>alert("File upload error!");</script>';

}
?>