<?php
include "coredb.php";

// Recovery data sent from Game Maker
$player = $_GET['player'];
$score = $_GET['score'];

// Check if the necessary data is present
if (isset($_GET["player"]) && isset($_GET["score"]))
{
    //Check id player is already present in leaderboard database
    if ($query = mysqli_prepare($mysqli, "SELECT Player FROM leaderboard WHERE Player = ?"))
    {
		mysqli_stmt_bind_param($query, "s", $player);
		mysqli_stmt_execute($query);
		$result = $query->get_result();
        // If player already present in leaderboard (result > 0)
        if ($row = $result->fetch_assoc())
        {
			// Check the previous record and compare it with the current record (update record only if current record > previous record)
			if ($query = mysqli_prepare($mysqli, "SELECT Score FROM leaderboard WHERE Player = ?"))
			{
				mysqli_stmt_bind_param($query, "s", $player);
				mysqli_stmt_execute($query);
				mysqli_stmt_bind_result($query, $previousRecord);
				mysqli_stmt_fetch($query);
				mysqli_stmt_close($query);
			}
			// If the previous record is less than the new record
			if ($previousRecord < $score)
			{
				// Update existing database record
				if ($query = $mysqli->prepare('UPDATE leaderboard SET Score = ? WHERE Player = ?'))
				{
					$query->bind_param("is", $score, $player);
					$query->execute();
					echo "Existing player record updated!";
				}
				else
				{
					echo "Error update data";
				}
				mysqli_stmt_close($query);
			}
			else
			{
				echo "No new records";
			}
        }
		// Otherwise if the player is not already present in the database (new player)
        else
        {
            // Create new record in database
			if ($query = mysqli_prepare($mysqli, "INSERT INTO leaderboard (Player, Score) VALUES (?, ?)"))
            {
		        mysqli_stmt_bind_param($query, "si", $player, $score);
		        mysqli_stmt_execute($query);
		        echo "New player record create!";
	        }
	        else
    	    {
	        	echo "Error create data";
	        }
			mysqli_stmt_close($query);
        }
	}
}
// If the necessary data are not present, it shows an error message
else
{
    echo "Data error received";
}

// Database connection close
$mysqli->close();
?>