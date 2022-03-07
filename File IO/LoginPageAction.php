<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login Page Action</title>
</head>
<?php

$flag=0;
 if ($_SERVER['REQUEST_METHOD'] === "POST")
 {
    function getdata($data)
    {
        $data=trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    $uname=getdata($_POST['uname']);
    $password=getdata($_POST['password']);
    $confirmpass=getdata($_POST['confirmpass']);


    if(empty($uname) or empty($password) or empty($confirmpass))
    {
      echo "Dear user please fill up all the field, fields can not be empty.";
    }

    else
    {
    define("FILENAME", "users.txt");
		$handle = fopen(FILENAME, "r");
		$fr = fread($handle, filesize(FILENAME)+1);
		$arr = json_decode($fr);
    $fc = fclose($handle);


         for ($i = 0; $i < count($arr); $i++)
         {
            if($arr[$i]->uname==$uname and $arr[$i]->password==$password and $password==$confirmpass)
            {
                $flag=1;
                break;
            }
         }


				 if($flag==1)
				 {
						header("Location:WelcomePage.html");
				 }


        else if($password!=$confirmpass)
         {
           echo "Dear user your password and confirm password do not match";
         }


        else
          {
            echo "Dear user no user name and password found in the file.";
          }
    }

}
?>
</body>
</html>
