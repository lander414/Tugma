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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['post_content'])) {
    $post_content = $_POST['post_content'];

    // Inserting of post into the database
    $sql = "INSERT INTO posts (userid, post_content) VALUES ('$user_id', '$post_content')";

    if ($mysqli->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}

// Close the database connection
$mysqli->close();
?>

<!-- HTML form for posting -->
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
$sql = "SELECT posts.post_content, users.username_ 
        FROM posts 
        JOIN users ON posts.userid = users.userid 
        ORDER BY posts.post_time DESC";

$result = $mysqli->query($sql);

if (!$result) {
    die("Error: " . $sql . "<br>" . $mysqli->error);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p><strong>" . $row['username_'] . ":</strong> " . $row['post_content'] . "</p>";
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
