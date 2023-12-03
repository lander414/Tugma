<?php
include("header.php"); 
?>

<style>
  .profile-photo {
    border-radius: 50%;
    width: 50px;  
    height: 50px;
  }

  .post-container, .comment-container {
    border: 1px solid #ddd;
    padding: 10px;
    margin-bottom: 10px;
    position: relative;
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
            echo '<img class="profile-photo" src="../profilephoto/' . $row['userid'] . '.' . $row['extension'] . '" alt="">';
        } else {
            echo '<img class="profile-photo" src="../profilephoto/default.jpg" alt="">';
        }

        // Display "Delete" button for the post owner
        if (isset($row['userid']) && $user_id == $row['userid']) {
            echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
            echo "<input type='hidden' name='post_id' value='" . $row['post_id'] . "'>";
            echo "<input type='submit' name='delete_post' value='Delete' class='delete-button'>";
            echo "</form>";
        }

        echo "<p><strong>" . $row['username_'] . ":</strong> " . $row['post_content'] . "</p>";

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
                    echo '<img class="profile-photo" src="../profilephoto/' . $commentRow['userid'] . '.' . $commentRow['commentor_extension'] . '" alt="">';
                } else {
                    echo '<img class="profile-photo" src="../profilephoto/default.jpg" alt="">';
                }

                echo "<div class='commenter-info'>";
                echo "<strong>" . $commentRow['username_'] . ":</strong> " . $commentRow['comment_content'];

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

// Close the database connection
$mysqli->close();
?>

<?php
include("footer.php");
?>
