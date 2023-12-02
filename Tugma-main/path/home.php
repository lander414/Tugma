<?php
include("header.php"); 
?>

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

    // Insert post content sa database
    $sql = "INSERT INTO posts (userid, post_content) VALUES ('$user_id', '$post_content')";

    if ($mysqli->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}

// Handle comment creation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comment_content']) && isset($_POST['post_id'])) {
    $comment_content = $_POST['comment_content'];
    $post_id = $_POST['post_id'];

    // Insert comment sa database
    $sql = "INSERT INTO comments (post_id, userid, comment_content) VALUES ('$post_id', '$user_id', '$comment_content')";

    if ($mysqli->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}

// Handle post deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_post']) && isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];

    // Delete neto yung  post and its associated comments
    $deletePostSql = "DELETE FROM posts WHERE post_id = '$post_id' AND userid = '$user_id'";
    $deleteCommentsSql = "DELETE FROM comments WHERE post_id = '$post_id'";

    if ($mysqli->query($deletePostSql) !== TRUE) {
        echo "Error deleting post: " . $mysqli->error;
    }

    if ($mysqli->query($deleteCommentsSql) !== TRUE) {
        echo "Error deleting comments: " . $mysqli->error;
    }
}

// Handle comment deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_comment']) && isset($_POST['comment_id'])) {
    $comment_id = $_POST['comment_id'];

    // Delete comment to
    $deleteCommentSql = "DELETE FROM comments WHERE comment_id = '$comment_id' AND userid = '$user_id'";

    if ($mysqli->query($deleteCommentSql) !== TRUE) {
        echo "Error deleting comment: " . $mysqli->error;
    }
}

// Close the database connection
$mysqli->close();
?>

<!-- form for posting -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="post_content">Write your post:</label><br>
    <textarea name="post_content" rows="4" cols="50"></textarea><br>
    <input type="submit" value="Post">
</form>

<?php
$host = "localhost";
$dbname = "tugma";
$username = "root";
$password = "";

$mysqli = mysqli_connect($host, $username, $password, $dbname);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Fetch all posts from all users
$sql = "SELECT posts.post_id, posts.post_content, users.userid, users.username_ 
        FROM posts 
        JOIN users ON posts.userid = users.userid 
        ORDER BY posts.post_time DESC";

$result = $mysqli->query($sql);

if (!$result) {
    die("Error: " . $sql . "<br>" . $mysqli->error);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div style='border: 1px solid #ddd; padding: 10px; margin-bottom: 10px;'>";
        echo "<p><strong>" . $row['username_'] . ":</strong> " . $row['post_content'] . "</p>";

        // Display "Delete" button para sa nag post mismo
        if (isset($row['userid']) && $user_id == $row['userid']) {
            echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
            echo "<input type='hidden' name='post_id' value='" . $row['post_id'] . "'>";
            echo "<input type='submit' name='delete_post' value='Delete'>";
            echo "</form>";
        }

        // form para sa comment
        echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
        echo "<input type='hidden' name='post_id' value='" . $row['post_id'] . "'>";
        echo "<label for='comment_content'>Write a comment:</label><br>";
        echo "<textarea name='comment_content' rows='2' cols='50'></textarea><br>";
        echo "<input type='submit' value='Submit Comment'>";
        echo "</form>";

        // Display ng comments for each post
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

                // Display ng delete button
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

        echo "</div>";  // Close ng post container
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
