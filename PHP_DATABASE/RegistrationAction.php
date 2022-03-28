<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registration Action</title>
</head>
<body>

	<h1>Registration Action</h1>

	<?php
		if ($_SERVER['REQUEST_METHOD'] === "POST")
		 {

			function test($data)
			{
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}

			$firstname = test($_POST['fname']);
			$lastname = test($_POST['lname']);

			if (empty($firstname) or empty($lastname)) {
				echo "Please fill up the form properly";
			}
			else
			{

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "todo";

$conn = new mysqli($hostname, $username, $password, $dbname);

if ($conn->connect_error)
{
	die("Connection Unsuccessful: " . $conn->connect_error);
}

$sql = "INSERT INTO Users (firstname, lastname) VALUES ('$firstname', '$lastname')";


if ($conn->query($sql) === TRUE)
{
echo "New record created successfully";
	} else
	{
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

$conn->close();

			}

		}
	?>

	<a href="registration.html">Create User</a>
	<br>
	<br>
	<a href="UserList.php">User List</a>


</body>
</html>
