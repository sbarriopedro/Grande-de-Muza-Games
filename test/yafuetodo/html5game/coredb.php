<?php

// Here you will have to enter all the data needed to connect to the database. Remember to fill in all the variables correctly.
$servername = "localhost"; // Server name used by the database
$username = "userofdb"; // The username of the user associated with the database
$password = "passwordofdb"; // String containing the user's password to access the database
$dbname = "nameofdb"; // String containing the name of the db on which the leaderboard data is saved

// Edit only the variables that are above this comment. Do not change the code below this comment!

// Create MySqli connection
$mysqli = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($mysqli->connect_error) {
    die("Database connection failed");
}

?>