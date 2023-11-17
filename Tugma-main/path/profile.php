<?php include("header.php");

if(!empty($_GET["un"])){  
  $user = GetUserByUsername($_GET["un"]);
  $profilephoto = GetProfilePhotoByUserId($user["userid"]);
  $bgphoto = GetBgPhotoByUserId($user["userid"]);
  $video = GetVideoByUserId($user["userid"]);
}
echo$_SESSION["userid"];


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
    
    <!-- -->
    <?php include("../db/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $rating = $_POST["rating"];
    DefaultRatingsByUserId($_SESSION["userid"],$rating, $user["userid"]);
    
}



mysqli_close($mysqli);

$rates = GetRatingsByUserId($user["userid"]);
$hasRated = 0;

foreach ($rates as $rate) {
  if ($rate["Ratedby"] == $_SESSION["userid"]) {
    $hasRated = 1;
    //print_r($rate);
    break;
  }
}

if ($hasRated === 0) {
  echo '<h2>Rate Me:</h2>
    <form action="' . $_SERVER['PHP_SELF'] . '?un=' . $user["username_"] . '" method="post">
        <label for="rating">Select your rating:</label>
        <select name="rating" id="rating">
            <option value="5">5 (Excellent)</option>
            <option value="4">4 (Very Good)</option>
            <option value="3">3 (Good)</option>
            <option value="2">2 (Fair)</option>
            <option value="1">1 (Poor)</option>
        </select>
        <br>
        <input type="submit" value="Submit Rating">
    </form>';
} elseif ($hasRated === 1) {
  echo "You already rated this user";
}
?>




</main>

<?php include("footer.php") ?>

              
