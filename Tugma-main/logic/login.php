<?php
include("../db/database.php");

$username=mysqli_real_escape_string($mysqli,$_POST["username"]);
$password = $_POST["password"];

if(       
            !empty($_POST["username"])&&
            !empty($_POST["password"])
){

  
  $query = "SELECT userid,password_ FROM users WHERE username_ ='$username'";
  
  $result = mysqli_query($mysqli,$query);
  if(mysqli_num_rows($result) >0){
    $data = mysqli_fetch_assoc($result);
    if(password_verify($password,$data["password_"])){
      session_start();
      $_SESSION["userid"] = $data["userid"];

     header("location: ../path/home.php");
    }else{
      echo"Wrong input";
    }
    

  }
  
  mysqli_free_result($result);
}


  