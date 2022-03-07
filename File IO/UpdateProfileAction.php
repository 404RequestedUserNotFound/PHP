<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Update Profile Action</title>
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
        $firstname = getdata($_POST['firstname']);
        $middlename = getdata($_POST['middlename']);
        $lastname = getdata($_POST['lastname']);
        $email = getdata($_POST['email']);
        $peradd = getdata($_POST['peradd']);
        $preadd = getdata($_POST['preadd']);
        $phone = getdata($_POST['phone']);
        $website = getdata($_POST['website']);
        $gender = getdata(@$_POST['gender']);
        $religion = getdata($_POST['religion']);
        $uname = getdata(@$_POST['uname']);


        			$isChecked = true;
        			if (empty($firstname))
        			{
        				$isValid = false;
        				$firstnameErr = "Dear user your first name can not be empty.";
        			}


        			if (empty($lastname))
        			{
        				$isValid = false;
        				$lastnameErr = "Dear user last name can not be empty.";
        			}


        			if(empty($email))
        			{
        				$isValid = false;
        				$emailErr = "Dear user email address can not be empty.";


        			}


        			else if(!filter_var($email,FILTER_VALIDATE_EMAIL))
        			{
        				$isValid = false;
        				$emailErr = "Dear user please check your email again.";
        			}



        			if (empty($peradd))
        			{
        				$isValid = false;
        				$peraddErr = "Dear user your permanent address can not be empty.";
        			}



        			if(empty($website))
        			{
        				$isValid = false;
        	    }


        			elseif (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website))
        			{
        	      $websiteErr = "Dear user please check your website url again.";
        	    }




        			if (empty($gender))
        			{
        				$isValid = false;
        				$genderErr = "Dear user please select your gender.";
        			}



        			if (empty($uname))
        			{
        				$isValid = false;
        				$unameErr = "Dear user please enter your user name.";
        			}



        			if (empty($gender))
        			{
        				$isValid = false;
        				$genderErr = "Dear user please select your gender.";
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

                        $arr[$i]->uname=$uname;
                        $arr[$i]->firstname=$firstname;
                        $arr[$i]->middlename=$middlename;
                        $arr[$i]->lastname=$lastname;
                        $arr[$i]->email=$email;
                        $arr[$i]->peradd=$peradd;
                        $arr[$i]->preadd=$preadd;
                        $arr[$i]->phone=$phone;
                        $arr[$i]->gender=$gender;
                        $arr[$i]->religion=$religion;
                        $arr[$i]->uname=$uname;

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
					echo "Dear sir, your profile has been successfully updated.";
					echo "<br>";

					echo "<a href='WelcomePage.html'>Go back top welcome page</a>";

				}

				else
				{
					echo "It looks like you are not a exxisting user.";
				}

			}

		}
?>
</body>
</html>
