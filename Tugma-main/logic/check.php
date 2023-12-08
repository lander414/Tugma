<?php

$host = "localhost";
$dbname = "tugma";
$username = "root";
$password = "";

$mysqli = mysqli_connect($host,  $username, $password,$dbname);

if(isset($_POST["username_"])&& !empty($_POST["username_"]))
{
  $query = "SELECT username_ FROM users WHERE username_ ='".$_POST['username_']."'";
  $result = mysqli_query($mysqli,$query);

  if(mysqli_num_rows($result)>0){
    echo '<p style="color:rgb(122, 68, 68);
    background-color: var(--font-color);
    position: absolute;
    top: -1.2em;
    padding-inline:1em;
    font-family: var(--font-family);
    border-radius: 10px;">Unavailable<p>';
  }else{
    echo '<p style="color:rgb(62, 97, 33);
    background-color: var(--font-color);
    position: absolute;
    top: -1.2em;
    padding-inline:1em;
    font-family: var(--font-family);
    border-radius: 10px;">Available<p>';
  }
}