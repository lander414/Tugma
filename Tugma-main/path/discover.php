<?php include("header.php");

$users = GetAllUserProfile();



?>
<link rel="stylesheet" href="../style/discover.css?v=<?php echo time(); ?>">
<main class="main-container">



  <?php
    foreach ($users as $user) {
      $profilephoto = GetProfilePhotoByUserId($user["userid"]);
      $bgphoto = GetBgPhotoByUserId($user["userid"]);
   
  echo '<div class="profile-container">';
             //
                if(!empty($bgphoto) && $bgphoto["status"]==1){
                  echo'<img class="bg-photo" src="../backgroundphoto/'.$bgphoto["userid"].'.'.$bgphoto["extension"].'" alt="">';
                }else{
                  echo' <img class="bg-photo" src="../backgroundphoto/default.jpg" alt="">';
                }
            
     echo '<div class="profile-container-2">
        <div class="basic-info">';
            //
                if(!empty($profilephoto) && $profilephoto["status"]==1){
                  echo'<img class="profile-photo" src="../profilephoto/'.$profilephoto["userid"].'.'.$profilephoto["extension"].'" alt="">';
                }else{
                  echo'<img class="profile-photo" src="../profilephoto/default.jpg" alt="">';
                }
             //
         echo '<a href="profile.php?un='.$user["username_"].'" class="display-name">'. $user["displayName_"].' </a>
        </div>
      </div>
    </div>';
  }
  ?>
</main>

<?php include("footer.php") ?>

              
