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



function DefaultVideoByUserId($userid){
  include("../db/database.php");
  $query ="INSERT INTO video (userid) VALUES($userid)";
  mysqli_query($mysqli,$query);
  mysqli_close($mysqli);
}









function executeQuery($query)
{
    include('../db/database.php');
    $result = mysqli_query($mysqli, $query);

    if (!$result) {
        die('Error executing query: ' . mysqli_error($mysqli));
    }

    mysqli_close($mysqli);
    return $result;
}


// ... (similar changes for other functions)


function GetAllUserProfile()
{
    $query = "SELECT username_, displayName_, userid FROM users";
    $result = executeQuery($query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function GetVideoByUserId($userid) {
  include("../db/database.php");
  $query = "SELECT * FROM video WHERE userid = $userid";
  $result = mysqli_query($mysqli, $query);
}
function DefaultRatingsByUserId($ratedBy, $rating, $userid)
{
    $query = "INSERT INTO ratings (Ratedby, rating, userid) VALUES($ratedBy, $rating, $userid)";
    executeQuery($query);
}

function GetRatingsByUserId($userid)
{
    $query = "SELECT * FROM ratings WHERE userid =$userid";
    $result = executeQuery($query);

    // Check if there are rows bago mag attempt
    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        return array(); // Return an empty array if there are no results
    }
}

function UpdateBioByUserId($newBio, $userid)
{
    $query = "UPDATE users SET bio_ ='$newBio' WHERE userid= $userid";
    executeQuery($query);
}

function UpdateProfilePhoto($userid,$ext){
    include("../db/database.php");
    $query ="UPDATE profilephoto SET userid =$userid,extension ='$ext', status =1 WHERE userid= $userid";
    mysqli_query($mysqli,$query);
    mysqli_close($mysqli);
  }

  function UpdateBgPhoto($userid,$ext){
    include("../db/database.php");
    $query ="UPDATE bgphoto SET userid =$userid,extension ='$ext', status =1 WHERE userid= $userid";
    mysqli_query($mysqli,$query);
    mysqli_close($mysqli);
  }

  function UpdateVideo($userid,$ext){
    include("../db/database.php");
    $query ="UPDATE video SET userid =$userid,extension ='$ext', status =1 WHERE userid= $userid";
    mysqli_query($mysqli,$query);
    mysqli_close($mysqli);
  }