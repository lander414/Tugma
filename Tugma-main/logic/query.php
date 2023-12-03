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


//para sa upload2.php
function UpdateProfilePhoto($userid, $ext) {
  include("../db/database.php");

  // Check if the user already has a profile photo
  $checkQuery = "SELECT * FROM profilephoto WHERE userid = $userid";
  $checkResult = mysqli_query($mysqli, $checkQuery);

  if (mysqli_num_rows($checkResult) > 0) {
      // User already has a profile photo, update the existing record
      $updateQuery = "UPDATE profilephoto SET extension = '$ext', status = 1 WHERE userid = $userid";
      mysqli_query($mysqli, $updateQuery);
  } else {
      // User doesn't have a profile photo, insert a new record
      $insertQuery = "INSERT INTO profilephoto (userid, extension, status) VALUES ($userid, '$ext', 1)";
      mysqli_query($mysqli, $insertQuery);
  }

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
function UpdateBgPhoto($userid, $ext) {
  include("../db/database.php");

  // Check if the user already has a background photo
  $checkQuery = "SELECT * FROM bgphoto WHERE userid = $userid";
  $checkResult = mysqli_query($mysqli, $checkQuery);

  if (mysqli_num_rows($checkResult) > 0) {
      // User already has a background photo, update the existing record
      $updateQuery = "UPDATE bgphoto SET extension = '$ext', status = 1 WHERE userid = $userid";
      mysqli_query($mysqli, $updateQuery);
  } else {
      // User doesn't have a background photo, insert a new record
      $insertQuery = "INSERT INTO bgphoto (userid, extension, status) VALUES ($userid, '$ext', 1)";
      mysqli_query($mysqli, $insertQuery);
  }

  mysqli_close($mysqli);
}


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

function UpdateVideo($userid,$ext){
  include("../db/database.php");
  $query ="UPDATE video SET userid =$userid,extension ='$ext', status =1 WHERE userid= $userid";
  mysqli_query($mysqli,$query);
  mysqli_close($mysqli);
}

function DefaultVideoByUserId($userid){
  include("../db/database.php");
  $query ="INSERT INTO video (userid) VALUES($userid)";
  mysqli_query($mysqli,$query);
  mysqli_close($mysqli);
}


function GetVideoByUserId($userid){
  include("../db/database.php");
  $query ="SELECT * FROM video WHERE userid =$userid";
  $result = mysqli_query($mysqli,$query);
  mysqli_close($mysqli);
  return  mysqli_fetch_assoc($result);
}

/////////////////////

function GetAllUserProfile() {
  include("../db/database.php");
  $query ="SELECT username_,displayName_,userid FROM users";
  $result = mysqli_query($mysqli,$query);
  mysqli_close($mysqli);
  return  mysqli_fetch_all($result,MYSQLI_ASSOC);
}


function DefaultRatingsByUserId($ratedBy,$rating,$userid){
  include("../db/database.php");
  $query ="INSERT INTO ratings (Ratedby,rating,userid) VALUES($ratedBy,$rating,$userid)";
  mysqli_query($mysqli,$query);
  mysqli_close($mysqli);
}

function GetRatingsByUserId($userid){
  include("../db/database.php");
  $query ="SELECT * FROM ratings WHERE userid =$userid";
  $result = mysqli_query($mysqli,$query);
  mysqli_close($mysqli);
  return  mysqli_fetch_all($result,MYSQLI_ASSOC);
}


function UpdateBioByUserId($newBio,$userid){
  include("../db/database.php");
  $query ="UPDATE users SET bio_ ='$newBio' WHERE userid= $userid";
  mysqli_query($mysqli,$query);
  mysqli_close($mysqli);
}
