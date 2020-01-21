<?php
include "coredb.php";

// Select from the database all the data (Player and Score), sorted in descending order.
//The limit is set from 0 to 10, so the first 10 best scores will be selected.
if ($query = $mysqli->query("SELECT * FROM leaderboard ORDER BY Score DESC LIMIT 0,10"))
{
	// For each row obtained
	while ($result= $query->fetch_assoc())
	{
		// Print the query results inside the web page separating them with the | character (this character will serve us to split every single data inside GM through a special script.
		echo $result['Player']."| ".$result['Score']."|";
	}
	// Query close
    $query->close();
}
// If the query is not executed correctly, it displays an error message
else
{
    echo "Database connection error";
}

// Database connection close
$mysqli->close();
?>