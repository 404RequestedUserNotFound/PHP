<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Delete Action</title>
</head>
<body>

	<h1>Delete Action Page</h1>

	<?php


		$hostname = "localhost";
		$username = "root";
		$password = "";
		$dbname = "todo";

		$conn = new mysqli($hostname, $username, $password, $dbname);


		if ($conn->connect_error)
		{
			die("Connection Unsuccessful: " . $conn->connect_error);
		}



		$sql = "DELETE FROM Users WHERE id = 0";

		if ($conn->query($sql) === TRUE)
		{
	  		echo "Data has been deleted succesfully";
		} else {
	  		echo "Error: " . $sql . "<br>" . $conn->error;
		}

		echo "<hr><hr>";

		$sql = "SELECT id, firstname, lastname FROM Users";
		$result = $conn->query($sql);


		if ($result->num_rows > 0)
		 {

			while($row = $result->fetch_assoc())
			 {
				echo "id: " . $row["id"] . " firstname: " . $row["firstname"] . " lastname: " . $row["lastname"];
				echo "<br>";
			}
		}
		else
		{
			"No record(s) found";
		}

		$conn->close();




	?>

	<a href="UserList.php">User List</a>

</body>
</html>
