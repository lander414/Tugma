<?php include("header.php");

if(!empty($_GET["un"])){  
  $user = GetUserByUsername($_GET["un"]);
  $profilephoto = GetProfilePhotoByUserId($user["userid"]);
  $bgphoto = GetBgPhotoByUserId($user["userid"]);
  $video = GetVideoByUserId($user["userid"]);
}



?>
<link rel="stylesheet" href="../style/profile.css?v=<?php echo time(); ?>">
<main class="main-container">

    <div class="profile-container">
             <?php
                 if(!empty($bgphoto) && $bgphoto["status"]==1){
                  echo'<img class="bg-photo" src="../backgroundphoto/'.$bgphoto["userid"].'.'.$bgphoto["extension"].'" alt="">';
                }else{
                  echo' <img class="bg-photo" src="../backgroundphoto/default.jpg" alt="">';
                } 
              ?>
      <div class="profile-container-2">
        <div class="basic-info">


              <?php
                if(!empty($profilephoto) && $profilephoto["status"]==1){
                  echo'<img class="profile-photo" src="../profilephoto/'.$profilephoto["userid"].'.'.$profilephoto["extension"].'" alt="">';
                }else{
                  echo'<img class="profile-photo" src="../profilephoto/default.jpg" alt="">';
                }
              ?>
          <p class="display-name"><?php echo$user["displayName_"]; ?></p>
          <p class="username"><?php echo"@".$user["username_"]; ?></p>
          <a href="../logic/upload.php" class="edit-profile-button">Edit Profile</a>
        </div>
         <div class="bio-container">
          <p class="bio"><?php echo$user["bio_"]; ?></p>
         </div>
      </div>
    </div>


    <video class="video-container" width="300" height="400" controls>
    <source src="../videos/<?php echo $video["userid"].".".$video["extension"];?>" type="video/mp4">
    </video>  


</main>

<?php include("footer.php") ?>

              
