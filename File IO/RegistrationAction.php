<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registration Page Action</title>
</head>
<body>

	<?php

		$firstnameErr = $lastnameErr = $emailErr = $birthdaycheckErr = $peraddErr = $preaddErr = $phoneErr = $websiteErr = $genderErr= $religionErr = $unameErr= $passwordErr = $confirmpassErr=  "";
		$firstname = $middlename = $lastname = $birthdaycheck = $email = $peradd = $preadd = $phone = $website =$gender = $religion = $uname= $password= $confirmpass = "";



		$isValid = true;
		$isChecked = false;


		if ($_SERVER['REQUEST_METHOD'] === "POST")
		{
			function test($data)
			{
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
			function validateUserAge($val){
				$val = strtotime($val);
				$min = strtotime('+18 years',$val);
				if(time() < $min){
					return False;
				}
				return True;
			}



			$firstname =  test($_POST['firstname']);
			$middlename = test($_POST['middlename']);
			$lastname =   test($_POST['lastname']);
			$email =      test($_POST['email']);
			$birthdaycheck = test($_POST['birthdaycheck']);
			$peradd = test($_POST['peradd']);
			$preadd = test($_POST['preadd']);
			$phone = test($_POST['phone']);
			$website = test($_POST['website']);
			$gender = test(@$_POST['gender']);
			$religion = test(@$_POST['religion']);
			$uname = test(@$_POST['uname']);
			$password = test(@$_POST['password']);
			$confirmpass = test(@$_POST['confirmpass']);








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


			if(empty($birthdaycheck))
			{
				$isValid = false;
				$birthdaycheckErr = "When is your birthday.?";
			}


			if(!validateUserAge($birthdaycheck))
			{
				$isValid = false;
				$birthdaycheckErr = "Dear user you are not old enough.";
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


			if (empty($password))
			{
				$isValid = false;
				$passwordErr = "Dear user please enter your desired password.";
			}



			if (empty($confirmpass))
			{
				$isValid = false;
				$confirmpassErr = "Dear user please re-enter your password to confirm.";
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


        if ($arr === NULL)
        {
          $SerialNo = 1;
  					$data=array("SerialNo." => $SerialNo,"firstname"=>"$firstname","lastname"=>"$lastname","gender=="=>"$gender","birthdaycheck"=>"$birthdaycheck","uname"=>"$uname","password"=>"$password","religion"=>"$religion","preadd"=>"$preadd","peradd"=>"$peradd");
  						$data = array($data);
  							$data = json_encode($data);
  								$fw = fwrite($handle, $data);
        }


        else
        {
  			$SerialNo = $arr[count($arr) - 1]->SerialNo;
  				$data=array("SerialNo" => $SerialNo+1,"firstname"=>"$firstname","lastname"=>"$lastname","gender"=>"$gender","birthdaycheck"=>"$birthdaycheck","uname"=>"$uname","password"=>"$password","religion"=>"$religion","preadd"=>"$preadd","peradd"=>"$peradd");
  					$arr[] = $data;
  						$data = json_encode($arr);
  							$fw = fwrite($handle, $data);
        }

        $fc = fclose($handle);

	     if($fw)
       {
           echo "<h2>Data Insertion Successful</h2>";
       }
    }

		}
	?>

	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" novalidate>

		<fieldset>
		<legend><b>Basic Information:</b></legend>

		<label for="fname">First name *:</label>
		<input type="text" name="firstname" id="fname" size="80" value=<?php echo $firstname ?>>
		<span><?php echo $firstnameErr; ?></span>
		<br><br>

		<label for="mname">Middle Name:</label>
		<input type="text" name="middlename" id="mname" size="80" value=<?php echo $middlename; ?>>
		<br><br>

		<label for="lname">Last Name *:</label>
		<input type="text" name="lastname" id="lname" size="80" value=<?php echo $lastname; ?>>
		<span><?php echo $lastnameErr; ?></span>
		<br><br>

		<label for="gender">Gender *:</label>
		<input type="radio" name="gender" value="MALE" >Male
		<input type="radio" name="gender" value="FEMALE" >Female
		<input type="radio" name="gender" value="OTHERS" >Others
		<span><?php echo $genderErr; ?></span>
		<br><br>


		<label for="religion">Religion *:</label>
		<select name="religion">
		<option value=null></option>
		<option value="ISLAM">ISLAM</option>
		<option value="HINDU">HINDU</option>
		<option value="CHRISTIAN">CHRISTIAN</option>
		<option value="BUDDHIST">BUDDHIST</option>
		</select>
		<span><?php echo $religionErr; ?></span>
		<br><br>

		<label for="birthdaycheck">Date of birth *:</label>
		<input type="date" name="birthdaycheck" id="birthdaycheck" size="80" value=<?php echo $birthdaycheck; ?>>
		<span><?php echo $birthdaycheckErr; ?></span>
		<br><br>

</fieldset>





		<fieldset>
		<legend><b>Contact Information :</b></legend>

		<label for="preadd">Present Address*:</label>
		<textarea name="preadd" rows="5" cols="40" placeholder="Please enter your present address" ><?php echo $preadd;?></textarea>
		<span><?php echo $preaddErr; ?></span>
		<br><br>

		<label for="peradd">Permanent Address*:</label>
		<textarea name="peradd" rows="5" cols="40" placeholder="Please enter your permanent address" ><?php echo $peradd;?></textarea>
		<span><?php echo $peraddErr; ?></span>
		<br><br>


		<label for="phone">Phone:</label>
		<input type="number" name="phone" id="phone" size="80" value=<?php echo $phone; ?>>
		<span><?php echo $phoneErr; ?></span>
		<br><br>


		<label for="email">Email*:</label>
		<input type="email" name="email" id="email" size="80" value=<?php echo $email; ?>>
		<span><?php echo $emailErr; ?></span>
		<br><br>

		<label for="website">Personal Website Link:</label>
		<input type="url" name="website">
		<span class="error"><?php echo $websiteErr;?></span>
		<br><br>


	</fieldset>


	<fieldset>
			<legend>Credentials : </legend>


			<label>User Name :</label>
			<input type="text" name="uname" >
			<span><?php echo $unameErr; ?></span>
			<br><br>

			<label>Password :</label>
			<input type="Password" name="password">
			<span><?php echo $passwordErr; ?></span>
			<br><br>

			<label>Confirm Password :</label>
			<input type="Password" name="confirmpass" ><span><?php echo $confirmpassErr; ?>
			</span>
			<br><br>

			<input type="submit" name="submit" value="SUBMIT">


	</fieldset>
	<a href="LoginPage.html">Go to login page</a>

</form>
<hr>

</body>
</html>
