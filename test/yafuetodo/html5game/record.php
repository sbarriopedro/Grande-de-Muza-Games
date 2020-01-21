<!DOCTYPE html>
<html>
<head>
	<title>Leaderboard</title>
	<style>
		table {
			border-collapse: collapse;
			width: 40%;
			color: #588c7e;
			font-family: monospace;
			font-size: 20px;
			text-align: left;
		}
		th {
			background-color: #588c7e;
			color: white;
		}
		tr:nth-child(even) {background-color: #f2f2f2}
	</style>
</head>
<body>
	<center>
		<table>
			<tr>
				<th>Player</th>
				<th>Score</th>
			</tr>
			<?php
			include "coredb.php";
			
			$sql = "SELECT * FROM leaderboard ORDER BY Score DESC";
			$result = $mysqli->query($sql);
			
			if ($result->num_rows > 0) {
				// Output data of each row
				while($row = $result->fetch_assoc()) {
					echo "<tr><td>" . $row["Player"]. "</td><td>" . $row["Score"] . "</td><td>";
				}
				} else { 
					echo "No results"; 
				}
				$conn->close();
			?>
		</table>
	</center>
</body>
</html>