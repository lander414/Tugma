<?php
include("../db/database.php");
include("query.php");

$email =mysqli_real_escape_string($mysqli,$_POST["email"]);
$displayname =mysqli_real_escape_string($mysqli,$_POST["displayName"]);
$username=mysqli_real_escape_string($mysqli,$_POST["username"]);
$password_hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);

 
if(         !empty($_POST["email"])&&
            !empty($_POST["displayName"])&&
            !empty($_POST["username"])&&
            !empty($_POST["password"])
){

  $query = "INSERT INTO users (email_, displayName_, username_, password_)
VALUES ('$email','$displayname','$username','$password_hashed')";

if(mysqli_query($mysqli,$query)){
  
$user =GetUserByUsername($username);
DefaultProfilePhotoByUserid($user["userid"]);
DefaultBgPhotoByUserId($user["userid"]);
  header("location: ../path/start.php");
}else{
  echo"error: ".mysqli_error($mysqli);
}

}else{
  echo"invalid input";
}
