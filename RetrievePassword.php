<?php
include"session.php";
if(isset($_POST['submit']))
{
  $connection = mysqli_connect("localhost", "root", "", "FYP") or die ("Couldn't connect to server");

  $StaffID = $_POST['StaffID'];
  $email = $_POST['email'];

  $sql="SELECT * FROM users WHERE Email='$email' AND StaffID='$StaffID'";
  $result= mysqli_query ($connection, $sql) or die ("Could not execute query");
  $myrow= mysqli_fetch_row ($result);

  	if(($StaffID==$myrow[1])&&($email==$myrow[3])){
      $str = "0123456789qwertzuioplkjhgfdsayxcvbnm";
			$str = str_shuffle($str);
			$str = substr($str, 0, 6);
			$url = "localhost/FYP/resetPassword.php?token=$str&email=$email";
      $sql1="UPDATE users SET Token='$str' WHERE Email='$email' AND StaffID='$StaffID'";
      $result1= mysqli_query ($connection, $sql1) or die ("Could not execute query");
      if ($result)
      {
        include 'testing.php';
      }
  }
  else{
    echo "Invalid details";
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>L_M_S | Password Recovery</title>
  </head>
  <body>
    <div class="box" style="height:65%;">
        <span>PASSWORD RECOVERY</span>
        <form method="post"  action="<?php $SELF_PHP; ?>">
          <div class="inputBox">
              <label><i class="fa fa-envelope-o" aria-hidden="true"></i>Email <font color='red'>  *</font></label>
              <input type="email" name="email"  placeholder="Email used to register" required >
          </div>
          <div class="inputBox">
              <label><i class="fa fa-user-o" aria-hidden="true"></i>Staff ID <font color='red'>  *</font></label>
              <input type="ID" name="StaffID"  placeholder="Staff ID" required >
          </div>
          <div class="sendbutton">
              <input type="submit" name="submit" value="Send">
              <i class="fa fa-paper-plane-o mr-4" aria-hidden="true"></i>
          </div>
        </form>
        <a href="\fyp\Login.php">
          <button>Back</button>
        </a>
    </div>
  </body>
</html>
