<?php include("../db/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $rating = $_POST["rating"];

    // Perform input validation here if needed.

    // Insert the rating into the database.

    if (mysqli_query($mysqli, $sql)) {
        echo "Rating submitted successfully!";
    } else {
        echo "Error submitting rating: " . mysqli_error($mysqli);
    }
    
}

print_r($user);


mysqli_close($mysqli);
?>

