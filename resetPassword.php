<?php
	if (isset($_GET["token"]) && isset($_GET["email"])) {
    $connection=mysqli_connect("localhost", "root", "", "FYP") or die ("Couldn't connect to server");

    $email = $connection->real_escape_string($_GET["email"]);
		$token = $connection->real_escape_string($_GET["token"]);

		$data = "SELECT * FROM users WHERE email='$email' AND token='$token'AND token !=''";
    $result= mysqli_query ($connection, $data) or die ("Could not execute query");
    $myrow= mysqli_fetch_row ($result);
		if ($result) {
			$str = "0123456789qwertzuioplkjhgfdsayxcvbnm";
			$str = str_shuffle($str);
			$str = substr($str, 0, 6);

      $options = [
      'cost' => 12,
  		];
  		$hashed_password = password_hash($str, PASSWORD_BCRYPT, $options);

      $updatequery="UPDATE users SET Password='$hashed_password', Token ='' WHERE email='$email' AND id=$myrow[0]";
      $result1= mysqli_query ($connection, $updatequery) or die ("Please try to input the email again");

        if ($result1)
        {
        	echo "Your new password is this six digits: $str";
          ?>
          <html>
            <br><br><span>Click &nbsp<a target="_blank" href="login.php"> here </a> &nbspto login<span>
          </html>
        <?php
        }
		}
    else {
			echo "Please check your link!";
		}
	}
  else {
		header("Location: login.php");
		exit();
	}
?>
