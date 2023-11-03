<?php
include("../db/database.php");
session_start();
if(empty($_SESSION["userid"])){
  header("location: start.php");
}
include("../logic/query.php");
$user = GetUserByUserId($_SESSION["userid"]);
$profilephoto = GetProfilePhotoByUserId($user["userid"]);
$bgphoto = GetBgPhotoByUserId($user["userid"]);
$video = GetVideoByUserId($user["userid"]);


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../style/main.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="../style/carousel.css?v=<?php echo time(); ?>">
</head>

<body>
  <nav class="nav-container">
    <div class="logo-container">
      <a href="home.php" class="logo">Tugma</a>
      <input class="search-bar" type="search" name="" id="" placeholder="Search...">
    </div>
    <div>
      
      <div class="right-nav-container">
        <span class="bulb-button">
          <ion-icon name="bulb"></ion-icon>
        </span>
        <span class="menu-button">
          <ion-icon name="grid-outline"></ion-icon>
        </span>
        <ul class="menus">
              <?php
              
               if(!empty($profilephoto) &&$profilephoto["status"]==1){
                echo'<img class="profile-picture" src="../profilephoto/'.$profilephoto["userid"].'.'.$profilephoto["extension"].'" alt="">';
              } else{
                echo'<img class="profile-picture" src="../profilephoto/default.jpg" alt="">';
              }
              ?>
          <li><a href="home.php">Home</a></li>
          <li><a href="profile.php">Profile</a></li>
          <li><a href="#">Admin</a></li>
          <li><a href="../logic/logout.php">Sign Out</a></li>
        </ul>
      </div>
</nav>



