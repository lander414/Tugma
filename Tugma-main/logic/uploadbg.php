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
    case "jpeg":
    case "jpg":
    case "jfif":
      $updateFileName = $_SESSION["userid"].".".$fileExt2;
      $fileDIR  = "../backgroundphoto/".$updateFileName;
      UpdateBgPhoto($_SESSION["userid"],$fileExt2);
      move_uploaded_file($filetmpName,$fileDIR);
      echo$fileDIR;
      break;
          default:
          echo"Error file type doesnt match allowed extension!";
          break;
  }
}else{
  echo"File upload error!".mysqli_error($mysqli);
}