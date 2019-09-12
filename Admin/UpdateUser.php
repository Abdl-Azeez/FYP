<?php
  session_start();
	$connection=mysqli_connect("localhost", "root", "", "FYP") or die ("Couldn't connect to server");
  $lid=intval($_GET['empId']);
  if (isset ($_POST['UpdateProfile'])){
  	$Full_Name = $_POST['Full_Name'];
  	$Username = $_POST['Username'];
  	$StaffID = $_POST['StaffID'];
  	$Email = $_POST['Email'];
  	$Mobile = $_POST['Mobile'];
  	$Gender =$_POST['Gender'];
    $user=$_SESSION['username'];
    $department=$_POST['department'];
    $Position=$_POST['Position'];
    $TOS = $_POST['TOS'];
    $EL=$_POST['EL'];
    $ML=$_POST['ML'];
    $AL=$_POST['AL'];
    $RL=$_POST['RL'];

  	$sql="UPDATE users SET StaffID = '$StaffID' , Username= '$Username' , StaffName='$Full_Name', Email ='$Email', Department= '$department', MobileNum= '$Mobile', Gender= '$Gender', Roles='$Position',
    EL='$EL', CL='$ML', Annual='$AL', OL='$RL', TOS='$TOS' WHERE Id=$lid";
  	$result= mysqli_query ($connection, $sql) or die ("Could not execute query");

    if ($result)
  	{
      echo "success";
    }

    else {
      echo "Profile not update Try again";
    }
  }
  ?>
