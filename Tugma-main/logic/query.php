<?php

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

function GetUserByUsername($un)
{
    $query = "SELECT userid, username_, displayName_, bio_, role FROM users WHERE username_='$un'";
    $result = executeQuery($query);
    return mysqli_fetch_assoc($result);
}

function GetUserByUserId($userid)
{
    $query = "SELECT userid, username_, displayName_, bio_, role FROM users WHERE userid =$userid";
    $result = executeQuery($query);
    return mysqli_fetch_assoc($result);
}

// ... (similar changes for other functions)

function GetProfilePhotoByUserId($userid) {
    include("../db/database.php");
    $query = "SELECT * FROM profilephoto WHERE userid = $userid";
    $result = mysqli_query($mysqli, $query);

}

function GetAllUserProfile()
{
    $query = "SELECT username_, displayName_, userid FROM users";
    $result = executeQuery($query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
function GetBgPhotoByUserId($userid) {
  include("../db/database.php");
  $query = "SELECT * FROM bgphoto WHERE userid = $userid";
  $result = mysqli_query($mysqli, $query);
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
