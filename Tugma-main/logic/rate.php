<?phpinclude("../db/database.php");
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
