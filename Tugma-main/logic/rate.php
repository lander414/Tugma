<?phpinclude("../db/database.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_id = 1; // Change this to the actual item ID you're rating.
    $rating = $_POST["rating"];
    $userid = 1; // Change this to the actual user ID or use a session variable for user identification.

    // Perform input validation here if needed.

    // Insert the rating into the database.
    $sql = "INSERT INTO ratings (item_id, rating, userid) VALUES ('$item_id', '$rating', '$userid')";

    if (mysqli_query($mysqli, $sql)) {
        echo "Rating submitted successfully!";
    } else {
        echo "Error submitting rating: " . mysqli_error($mysqli);
    }
    
}


mysqli_close($mysqli);
?>


<!DOCTYPE html>
<html>
<head>
    <title>Dropdown Rating System</title>
</head>
<body>
    <h2>Rate Me:</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="rating">Select your rating:</label>
        <select name="rating" id="rating">
            <option value="5">5 (Excellent)</option>
            <option value="4">4 (Very Good)</option>
            <option value="3">3 (Good)</option>
            <option value="2">2 (Fair)</option>
            <option value="1">1 (Poor)</option>
        </select>
        <br>
        <input type="submit" value="Submit Rating">
    </form>
</body>
</html>
