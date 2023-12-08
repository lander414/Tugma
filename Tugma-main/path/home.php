<?php
include("header.php"); 
?>
<style>
  @import url(../style/var.css);
  
  .commentor-username{
    color: white !important;
    position: relative;
  top: -3em;
    left: 4em;
  }

input[type="submit"] {
  background-color: #4caf50;
  color: white;
  padding: 10px 15px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 16px;
}

input[type="submit"]:hover {
  background-color: #4caf50;
}

    textarea{
        resize: none;
        outline: none;  
        border-radius: 3px;
    }
    textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  font-family: 'Arial', sans-serif;
  font-size: 14px;
  line-height: 1.5;
}

textarea:focus {
  border-color: #007BFF; 
  box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); 
}
  .top-rated-container {

  width: 30%;
  border: 2px outset #ddd;
  padding: 10px;
  margin-right: 20px;
  position: absolute;
  right: 0; 
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

  .top-rated-users h3 {
  font-size: 18px;
  margin-bottom: 10px;
}

.top-rated-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.top-rated-list-item {
  margin-bottom: 15px;
}

.top-rated-list-item img {
  width: 50px;
  height: 50px;
  border-radius: 50%; 
  margin-right: 10px;
}

.top-rated-list-item a {
  color: #333;
  text-decoration: none;
  font-weight: bold;
}

.top-rated-list-item span {
  color: #666;
}
  .post-container {
    background-color: black!important;
    border-radius: 3px;
    width: 90%; 
    color: white !important;
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
        $profilePhotoPath = '../profilephoto/' . $topRatedRow['userid'] . '.jpg';
        if (file_exists($profilePhotoPath)) {
          echo '<img src="' . $profilePhotoPath . '" alt="">';
        } else {
          // Display default photo if the profile photo doesn't exist
          echo '<img src="../profilephoto/default.jpg" alt="">';
        }

        echo '</a>';
        echo '<a href="profile.php?un=' . $topRatedRow['username_'] . '">' . $topRatedRow['username_'] . '</a>';
        echo ' - Average Rating: ' . number_format($topRatedRow['avg_rating'], 2);
        echo '</li>';
      }
      ?>
    </ul>
  </div>
</div>
<style>

.all-post-container{
  padding: 1em;
  border-radius: 3em;
  width: 60%;
  align-content: center ;
}
    .post-username{
        position: absolute;
        left: 4.5em;
        color: white !important;
    }
  .profile-photo {
    border-radius: 50%;
    width: 50px;  
    height: 50px;
  }

  .post-container, .comment-container {
    padding: 10px;
    margin-bottom: 10px;
    position: relative;
  }
  .post-container {
  max-width: 600px;
  margin: 20px auto;
  padding: 20px;
  border: 1px solid gray;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  background-color: rgba(255, 255, 255, 0.8); 
  color: #333; 
}


  .delete-button {  
    position: absolute;
    top: 5px;
    right: 5px;
  }

  .comment {
    margin-left: 20px;
  }

  .commenter-info {
    display: flex;
    align-items: center;
  }

  .commenter-info img {
    margin-right: 10px;
  }
</style>

<?php
$host = "localhost";
$dbname = "tugma";
$username = "root";
$password = "";

$mysqli = mysqli_connect($host, $username, $password, $dbname);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$user_id = $_SESSION['userid']; 

// Handle post creation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['post_content'])) {
    $post_content = $_POST['post_content'];

    // Insert post into the database
    $sql = "INSERT INTO posts (userid, post_content) VALUES ('$user_id', '$post_content')";

    if ($mysqli->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}

// Handle post deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_post']) && isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];

    // Delete the post and its associated comments
    $deletePostSql = "DELETE FROM posts WHERE post_id = '$post_id' AND userid = '$user_id'";
    $deleteCommentsSql = "DELETE FROM comments WHERE post_id = '$post_id'";

    if ($mysqli->query($deletePostSql) !== TRUE) {
        echo "Error deleting post: " . $mysqli->error;
    }

    if ($mysqli->query($deleteCommentsSql) !== TRUE) {
        echo "Error deleting comments: " . $mysqli->error;
    }
}

// Handle comment creation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comment_content']) && isset($_POST['post_id'])) {
    $comment_content = $_POST['comment_content'];
    $post_id = $_POST['post_id'];

    // Insert comment into the database
    $comment_sql = "INSERT INTO comments (post_id, userid, comment_content) VALUES ('$post_id', '$user_id', '$comment_content')";

    if ($mysqli->query($comment_sql) !== TRUE) {
        echo "Error: " . $comment_sql . "<br>" . $mysqli->error;
    }
}

// Post form
echo'<div class="all-post-container">';
echo "<div class='post-container'>";
echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
echo "<label for='post_content'>Write your post:</label><br>";
echo "<textarea name='post_content' rows='4' cols='50'></textarea><br>";
echo "<input type='submit' value='Post'>";
echo "</form>";
echo "</div>";

// Fetch all posts from all users
$sql = "SELECT posts.post_id, posts.post_content, users.userid, users.username_, profilephoto.extension, profilephoto.status
        FROM posts 
        JOIN users ON posts.userid = users.userid 
        LEFT JOIN profilephoto ON users.userid = profilephoto.userid
        ORDER BY posts.post_time DESC";

$result = $mysqli->query($sql);

if (!$result) {
    die("Error: " . $sql . "<br>" . $mysqli->error);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='post-container'>";
      

        // Display circular profile photo
        if (!empty($row['extension']) && $row['status'] == 1) {
            // Make the profile photo clickable
            echo '<a href="profile.php?un=' . $row['username_'] . '">';
            echo '<img class="profile-photo" src="../profilephoto/' . $row['userid'] . '.' . $row['extension'] . '" alt="">';
            echo '</a>';
        } else {
            // Make the profile photo clickable
            echo '<a href="profile.php?un=' . $row['username_'] . '">';
            echo '<img class="profile-photo" src="../profilephoto/default.jpg" alt="">';
            echo '</a>';
        }

        // Make the username clickable
        echo '<a href="profile.php?un=' . $row['username_'] . '" class="post-username"><p><strong>' . $row['username_'] . ':</strong></p></a>';

        // Display "Delete" button for the post owner
        if (isset($row['userid']) && $user_id == $row['userid']) {
            echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
            echo "<input type='hidden' name='post_id' value='" . $row['post_id'] . "'>";
            echo "<input type='submit' name='delete_post' value='Delete' class='delete-button'>";
            echo "</form>";
        }

        echo "<p>" . $row['post_content'] . "</p>";

        // Comment form
        echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
        echo "<input type='hidden' name='post_id' value='" . $row['post_id'] . "'>";
        echo "<label for='comment_content'>Write a comment:</label><br>";
        echo "<textarea name='comment_content' rows='2' cols='50'></textarea><br>";
        echo "<input type='submit' value='Submit Comment'>";
        echo "</form>";

        // Display comments for each post
        $postId = $row['post_id'];
        $commentSql = "SELECT comments.comment_id, comments.comment_content, comments.userid, users.username_, profilephoto.extension AS commentor_extension, profilephoto.status AS commentor_status
                       FROM comments
                       JOIN users ON comments.userid = users.userid
                       LEFT JOIN profilephoto ON users.userid = profilephoto.userid
                       WHERE comments.post_id = '$postId'
                       ORDER BY comments.comment_time ASC";

        $commentResult = $mysqli->query($commentSql);
        

        if (!$commentResult) {
            die("Error: " . $commentSql . "<br>" . $mysqli->error);
        }

        if ($commentResult->num_rows > 0) {
            echo "<div class='comment-container'>";
            while ($commentRow = $commentResult->fetch_assoc()) {
                echo "<div class='comment'>";

                // Display circular profile photo for the commentor
                if (!empty($commentRow['commentor_extension']) && $commentRow['commentor_status'] == 1) {
                    // Make the profile photo clickable
                    echo '<a href="profile.php?un=' . $commentRow['username_'] . '">';
                    echo '<img class="profile-photo" src="../profilephoto/' . $commentRow['userid'] . '.' . $commentRow['commentor_extension'] . '" alt="">';
                    echo '</a>';
                } else {
                    // Make the profile photo clickable
                    echo '<a href="profile.php?un=' . $commentRow['username_'] . '">';
                    echo '<img class="profile-photo" src="../profilephoto/default.jpg" alt="">';
                    echo '</a>';
                }

                echo "<div class='commenter-info'>";
                // Make the username clickable
                echo '<a href="profile.php?un=' . $commentRow['username_'] . '" class="commentor-username"><strong>' . $commentRow['username_'] . ':</strong></a>';
                echo $commentRow['comment_content'];

                // Display delete button for the comment owner
                if (isset($commentRow['userid']) && $user_id == $commentRow['userid']) {
                    echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
                    echo "<input type='hidden' name='comment_id' value='" . $commentRow['comment_id'] . "'>";
                    echo "<input type='submit' name='delete_comment' value='Delete' class='delete-button'>";
                    echo "</form>";
                }

                echo "</div>";  // Close commenter-info
                echo "</div>";  // Close comment
            }
            echo "</div>";  // Close comment-container
        }

        echo "</div>";  // Close post-container
    }
} else {
    echo "No posts found.";
}
echo'</div>';

// Close the database connection
$mysqli->close();
?>

<?php
include("footer.php");
?>