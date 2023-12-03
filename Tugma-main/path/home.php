<?php
include("header.php"); 
?>

<style>
  .profile-photo {
    border-radius: 50%;
    width: 50px;  /* Adjust the size as needed */
    height: 50px;
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

// Handle post creation, comment creation, post deletion, comment deletion (your existing code)

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
        echo "<div style='border: 1px solid #ddd; padding: 10px; margin-bottom: 10px;'>";

        // Display circular profile photo
        if (!empty($row['extension']) && $row['status'] == 1) {
            echo '<img class="profile-photo" src="../profilephoto/' . $row['userid'] . '.' . $row['extension'] . '" alt="">';
        } else {
            echo '<img class="profile-photo" src="../profilephoto/default.jpg" alt="">';
        }

        echo "<p><strong>" . $row['username_'] . ":</strong> " . $row['post_content'] . "</p>";

        // Display "Delete" button for the post owner
        if (isset($row['userid']) && $user_id == $row['userid']) {
            echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
            echo "<input type='hidden' name='post_id' value='" . $row['post_id'] . "'>";
            echo "<input type='submit' name='delete_post' value='Delete'>";
            echo "</form>";
        }

        // Comment form
        echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
        echo "<input type='hidden' name='post_id' value='" . $row['post_id'] . "'>";
        echo "<label for='comment_content'>Write a comment:</label><br>";
        echo "<textarea name='comment_content' rows='2' cols='50'></textarea><br>";
        echo "<input type='submit' value='Submit Comment'>";
        echo "</form>";

        // Display comments for each post
        $postId = $row['post_id'];
        $commentSql = "SELECT comments.comment_id, comments.comment_content, comments.userid, users.username_
                       FROM comments
                       JOIN users ON comments.userid = users.userid
                       WHERE comments.post_id = '$postId'
                       ORDER BY comments.comment_time ASC";

        $commentResult = $mysqli->query($commentSql);

        if (!$commentResult) {
            die("Error: " . $commentSql . "<br>" . $mysqli->error);
        }

        if ($commentResult->num_rows > 0) {
            echo "<ul>";
            while ($commentRow = $commentResult->fetch_assoc()) {
                echo "<li><strong>" . $commentRow['username_'] . ":</strong> " . $commentRow['comment_content'];

                // Display delete button for the comment owner
                if (isset($commentRow['userid']) && $user_id == $commentRow['userid']) {
                    echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
                    echo "<input type='hidden' name='comment_id' value='" . $commentRow['comment_id'] . "'>";
                    echo "<input type='submit' name='delete_comment' value='Delete'>";
                    echo "</form>";
                }

                echo "</li>";
            }
            echo "</ul>";
        }

        echo "</div>";  // Close the post container
    }
} else {
    echo "No posts found.";
}

// Close the database connection
$mysqli->close();
?>

<?php
include("footer.php");
?>
