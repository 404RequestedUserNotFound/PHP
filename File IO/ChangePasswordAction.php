<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Change Password Action</title>
</head>
<body>


	<?php
	$flag=0;
  $isValid = true;
  $isChecked = false;

		if ($_SERVER['REQUEST_METHOD'] === "POST")
    {

			  function getdata($data)
        {
				      $data = trim($data);
				          $data = stripslashes($data);
				              $data = htmlspecialchars($data);
				                  return $data;
			  }

			  $SerialNo = getdata(@$_POST['SerialNo']);
        	$password = getdata($_POST['password']);
        		$confirmpass = getdata($_POST['confirmpass']);



        if (empty($password))
        {
          $isValid = false;
        }



        if (empty($confirmpass))
        {
          $isValid = false;
        }



			else
      {
				define("FILENAME", "users.txt");
				$handle = fopen(FILENAME, "r");
				$fr = fread($handle, filesize(FILENAME)+1);
				$arr = json_decode($fr);
				$fc = fclose($handle);
				$handle = fopen(FILENAME, "w");



				for ($i = 0; $i < count($arr); $i++)
        {

					if ($SerialNo == @$arr[$SerialNo]->SerialNo)
          {
            $arr[$i]->password=$password;
            $arr[$i]->confirmpass=$confirmpass;


						$flag=1;
						break;
					}


					else
					{
						$flag=0;
						break;
					}

				}

				$data = json_encode($arr);
					$fw = fwrite($handle, $data);
						$fc = fclose($handle);

				if ($flag==1)
				{
					echo "Dear sir, your password has been successfully updated.";
					echo "<br>";

					echo "<a href='loginPage.html'>Go back to login page</a>";

				}

				else
				{
					echo "It looks like you are not a existing user.";
				}

			}
		}
	?>
</body>
</html>
