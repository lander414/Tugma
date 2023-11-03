<?php
function GetUserByUsername($un){
  include('../db/database.php');
  $result =mysqli_query($mysqli,"SELECT userid,username_,displayName_,bio_,role FROM users WHERE username_='$un'");
  mysqli_close($mysqli);
 return mysqli_fetch_assoc($result);
}

function GetUserByUserId($userid){
  include("../db/database.php");
  $query = "SELECT userid,username_,displayName_,bio_,role FROM users WHERE userid =$userid";
  $result = mysqli_query($mysqli,$query);
  mysqli_close($mysqli);
    return  mysqli_fetch_assoc($result);
}


/////////////
/* function GetProfilePhotoByUsername($un){
  include("../db/database.php");
  $query ="SELECT * FROM profilephoto WHERE username_='$un'";
  $result = mysqli_query($mysqli,$query);
  mysqli_close($mysqli);
  return  mysqli_fetch_assoc($result);
} */
function GetProfilePhotoByUserId($userid){
  include("../db/database.php");
  $query ="SELECT * FROM profilephoto WHERE userid =$userid";
  $result = mysqli_query($mysqli,$query);
  mysqli_close($mysqli);
  return  mysqli_fetch_assoc($result);
}
//Profile photo
//Para sa sign uup.
function DefaultProfilePhotoByUserId($userid){
  include("../db/database.php");
  $query ="INSERT INTO profilephoto (userid) VALUES($userid)";
  mysqli_query($mysqli,$query);
  mysqli_close($mysqli);
}
/* function InsertProfilePhoto($userid,$ext){
  include("../db/database.php");
  $query ="INSERT INTO profilephoto (userid,extension,status) VALUES($userid,'$ext',1)";
  mysqli_query($mysqli,$query);
  mysqli_close($mysqli);
} */

//para sa upload2.php
function UpdateProfilePhoto($userid,$ext){
  include("../db/database.php");
  $query ="UPDATE profilephoto SET userid =$userid,extension ='$ext', status =1 WHERE userid= $userid";
  mysqli_query($mysqli,$query);
  mysqli_close($mysqli);
}
/////////////////

//BgPhoto
//para sa sign up
function DefaultBgPhotoByUserId($userid){
  include("../db/database.php");
  $query ="INSERT INTO bgphoto (userid) VALUES($userid)";
  mysqli_query($mysqli,$query);
  mysqli_close($mysqli);
}

function GetBgPhotoByUserId($userid){
  include("../db/database.php");
  $query ="SELECT * FROM bgphoto WHERE userid =$userid";
  $result = mysqli_query($mysqli,$query);
  mysqli_close($mysqli);
  return  mysqli_fetch_assoc($result);
}

//para sa uploadbg.php
function UpdateBgPhoto($userid,$ext){
  include("../db/database.php");
  $query ="UPDATE bgphoto SET userid =$userid,extension ='$ext', status =1 WHERE userid= $userid";
  mysqli_query($mysqli,$query);
  mysqli_close($mysqli);

// para sa upload video
function VideoUpload($userid){
  include("../db/database.php");
  $query ="INSERT INTO video (userid) VALUES($userid)";
  mysqli_query($mysqli,$query);
  mysqli_close($mysqli);
}
function VideoGet($userid){
  include("../db/database.php");
  $query ="SELECT * FROM video WHERE userid =$userid";
  $result = mysqli_query($mysqli,$query);
  mysqli_close($mysqli);
  return  mysqli_fetch_assoc($result);
}
}
function UpdateVideo($userid,$ext){
  include("../db/database.php");
  $query ="UPDATE video SET userid =$userid,extension ='$ext', status =1 WHERE userid= $userid";
  mysqli_query($mysqli,$query);
  mysqli_close($mysqli);
}
//<<<<<<< main

//=======
// main
function DefaultVideoByUserId($userid){
  include("../db/database.php");
  $query ="INSERT INTO video (userid) VALUES($userid)";
  mysqli_query($mysqli,$query);
  mysqli_close($mysqli);
}

//<<<<<<< main
function GetVideoByUserId($userid){
  include("../db/database.php");
  $query ="SELECT * FROM video WHERE userid =$userid";
  $result = mysqli_query($mysqli,$query);
  mysqli_close($mysqli);
  return  mysqli_fetch_assoc($result);
}
//=======
//>>>>>>> main
