<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose a Movie</title>
    <link rel="stylesheet" href="booking.css">
    <style>
        /* Custom CSS for the MainPage link */
        /* Custom CSS for the MainPage link */
nav ul li:first-child a {
    font-size: 24px; /* Increase the font size */
    font-weight: bold; /* Make the text bold */
    padding-left: 20px; /* Add padding to the left */
    margin-left: -20px; /* Move the link more to the left */
}

    </style>
</head>
<body>
<header>
        <!-- Header content -->
        <div class="container">
            <h1>Movie Selection</h1>
            <nav>
                <ul>
                    <li><a href="MainPage.php">MainPage</a></li>
                    <li><a href="booking.php" class="active">Choose a Movie</a></li>
                    
                    <li><a href="logout.php">Log Out</a></li> <!-- Change to Log Out button -->
                </ul>
            </nav>
        </div>
    </header>

<div class="column">
    <div class="movie">
        <a href="table1.php"> <!-- Update href attribute to point to table1.php -->
            <div class="movie-box">
                <img src="endgame.png" alt="Movie 1">
                <div class="movie-info">
                    <h3>Avengers: Endgame</h3>
                    <p>After Thanos, an intergalactic warlord, disintegrates half of the universe, the Avengers must reunite and assemble again to reinvigorate their trounced allies and restore balance.</p>
                </div>
            </div>
        </a>
    </div>

    <div class="movie">
        <a href="table2.php?movie=2">
            <div class="movie-box">
                <img src="bahubali.jpeg" alt="Movie 2">
                <div class="movie-info">
                    <h3>Baahubali: The Beginning</h3>
                    <p>In the kingdom of Mahishmati, Shivudu falls in love with a young warrior woman. While trying to woo her, he learns about the conflict-ridden past of his family and his true legacy.</p>
                </div>
            </div>
        </a>
    </div>
    <div class="movie">
        <a href="table3.php?movie=3">
            <div class="movie-box">
                <img src="godxkong.jpg" alt="Movie 3">
                <div class="movie-info">
                    <h3>Godzilla x Kong: The New Empire</h3>
                    <p>Godzilla and the almighty Kong face a colossal threat hidden deep within the planet, challenging their very existence and the survival of the human race.</p>
                </div>
            </div>
        </a>
    </div>
</div>
</body>
</html>
