<?php
	session_start();
	$connection=mysqli_connect("localhost", "root", "", "FYP") or die ("Couldn't connect to server");
  if (isset ($_POST['UpdatePass'])){
  	$password = $_POST['password'];
    $NewPassword1 = $_POST['NewPassword1'];
    $NewPassword2 = $_POST['NewPassword2'];
		//$hashed_password = password_hash($NewPassword2, PASSWORD_DEFAULT);
		$options = [
    'cost' => 12,
		];
		$hashed_password = password_hash($NewPassword2, PASSWORD_BCRYPT, $options);
		$user=$_SESSION['username'];

    $sql="SELECT * FROM users WHERE username='$user' AND roles='Staff'";
    $result= mysqli_query ($connection, $sql) or die ("Could not execute query");
    $myrow= mysqli_fetch_row ($result);

    	if(password_verify($password, $myrow[4]))
      {
          if ($NewPassword1==$NewPassword2)
          {
          	$sql="UPDATE users SET Password = '$hashed_password' WHERE username='$user' AND roles='Staff'";
          	$result= mysqli_query ($connection, $sql) or die ("Could not execute query");

            if ($result)
            {
              echo "success";
							session_destroy();
            }

            else {
              echo "Password not update Try again";
            }
          }

          else {
            echo "New Password and Confirm Password Field do not match";
          }
      }

      else{
        echo "Your current password you typed is incorrect";
      }


  }
  ?>
