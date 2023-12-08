<?php
include("header.php");

function getUsersForPage($page, $usersPerPage) {
    $start = ($page - 1) * $usersPerPage;
    $end = $start + $usersPerPage;

    $allUsers = GetAllUserProfile();
  shuffle($allUsers);
    $users = array_slice($allUsers, $start, $usersPerPage);

    return $users;
}

$usersPerPage = 5;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$users = getUsersForPage($page, $usersPerPage);

?>
<link rel="stylesheet" href="../style/discover.css?v=<?php echo time(); ?>">
<main class="main-container">

  <?php
  foreach ($users as $user) {
    if ($user["userid"] === $_SESSION["userid"]) {
      continue;
    }
    $profilephoto = GetProfilePhotoByUserId($user["userid"]);
    $bgphoto = GetBgPhotoByUserId($user["userid"]);

    echo '<div class="profile-container">';
    
    if (!empty($bgphoto) && $bgphoto["status"] == 1) {
      echo '<img class="bg-photo" src="../backgroundphoto/' . $bgphoto["userid"] . '.' . $bgphoto["extension"] . '" alt="">';
    } else {
      echo ' <img class="bg-photo" src="../backgroundphoto/default.jpg" alt="">';
    }

    echo '<div class="profile-container-2">
        <div class="basic-info">';

    if (!empty($profilephoto) && $profilephoto["status"] == 1) {
      echo '<img class="profile-photo" src="../profilephoto/' . $profilephoto["userid"] . '.' . $profilephoto["extension"] . '" alt="">';
    } else {
      echo '<img class="profile-photo" src="../profilephoto/default.jpg" alt="">';
    }

    // Display user's name and link to profile
    echo '<div class="user-info">';
    echo '<a href="profile.php?un=' . $user["username_"] . '" class="display-name">' . $user["displayName_"] . ' </a>';
    
   
    echo '</div>';
    
    echo '</div>
      </div>
    </div>';
  }
  ?>

  <div class="pagination"> 
    <?php
    $totalPages = ceil(count(GetAllUserProfile()) / $usersPerPage);
    for ($i = 1; $i <= $totalPages; $i++) {
      echo '<a class="pagination-num" href="?page=' . $i . '">' . $i . '</a>';
    }
    ?>
  </div>
</main>

<?php include("footer.php") ?>