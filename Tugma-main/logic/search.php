<?php 
include("../db/database.php");
session_start();

if(isset($_POST['value'])){
  $input = $_POST['value'];
  $result = mysqli_query($mysqli,"SELECT username_ FROM users WHERE username_ LIKE '".$input."%' ORDER BY username_ ASC");
  $count = mysqli_num_rows($result);
  if($count > 0){
    while($user = mysqli_fetch_assoc($result)){
      if ($user["username_"]== $_SESSION["username"]){
        continue;
      }
        echo '
        <a class="searched-user" href ="profile.php?un='.$user["username_"].'"> '.$user["username_"].'</a> <br>
        ';
    }
} 

mysqli_free_result($result);
}

?>