<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User List</title>
</head>
<body>

	<h1>User List</h1>

	<?php

	$firstnameErr = $lastnameErr ="";
	$firstname = $lastname = "";


		$hostname = "localhost";
		$username = "root";
		$password = "";
		$dbname = "todo";

		$conn = new mysqli($hostname, $username, $password, $dbname);


		if ($conn->connect_error)
		{
			die("Connection Unsuccessful: " . $conn->connect_error);
		}



		$sql = "SELECT id, firstname, lastname FROM Users";
		$result = $conn->query($sql);


		if ($result->num_rows > 0)
		 {

			while($row = $result->fetch_assoc())
			{
				echo "User ID: " . $row["id"] . " First Name: " . $row["firstname"] . " First Name: " . $row["lastname"];
				echo "<br>";
			}
		}
		else
		{
			"No record(s) found";
		}

		$conn->close();
	?>

	<br><br>

	<a href="registration.html">Create User</a><br>
	<a href="DeleteAction.php">Click to delete user data</a>


</body>
</html>
