<?php
include("header.php"); 
?>

<style>
  .top-rated-container {
    float: left;
    width: 30%;
    border: 1px solid #ddd;
    padding: 10px;
    margin-right: 20px;
  }

  .top-rated-users {
    display: block;
  }

  .top-rated-users h3 {
    font-size: 18px;
    margin-bottom: 10px;
  }

  .top-rated-list {
    list-style-type: none;
    padding: 0;
  }

  .top-rated-list-item {
    margin-bottom: 10px;
    display: flex;
    align-items: center;
  }

  .top-rated-list-item a {
    text-decoration: none;
    color: #333;
    display: flex;
    align-items: center;
  }

  .top-rated-list-item img {
    border-radius: 50%;
    width: 30px;
    height: 30px;
    margin-right: 10px;
  }

  .post-container {
    width: 60%; /* Adjust the width as needed */
  }
</style>

<?php
include("../db/database.php");  // Adjust the path as needed

// Fetch top 5 rated users
$topRatedSql = "SELECT users.userid, users.username_, AVG(ratings.rating) AS avg_rating
                FROM users
                LEFT JOIN ratings ON users.userid = ratings.userid
                GROUP BY users.userid
                ORDER BY avg_rating DESC
                LIMIT 5";

$topRatedResult = $mysqli->query($topRatedSql);

if (!$topRatedResult) {
    die("Error: " . $topRatedSql . "<br>" . $mysqli->error);
}
?>

<div class="top-rated-container">
  <div class="top-rated-users">
    <h3>Top 5 Rated Artists</h3>
    <ul class="top-rated-list">
      <?php
      while ($topRatedRow = $topRatedResult->fetch_assoc()) {
        echo '<li class="top-rated-list-item">';
        echo '<a href="profile.php?un=' . $topRatedRow['username_'] . '">';
        // Display circular profile photo for the top-rated user
        echo '<img src="../profilephoto/' . $topRatedRow['userid'] . '.jpg" alt="">';  // Replace with the actual profile photo path
        echo '</a>';
        echo '<a href="profile.php?un=' . $topRatedRow['username_'] . '">' . $topRatedRow['username_'] . '</a>';
        echo ' - Average Rating: ' . number_format($topRatedRow['avg_rating'], 2);
        echo '</li>';
      }
      ?>
    </ul>
  </div>
</div>

<?php

$mysqli->close();
?>
<?php
include("footer.php"); ?>
