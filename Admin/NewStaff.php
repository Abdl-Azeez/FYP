<?php
  $connection=mysqli_connect("localhost", "root", "", "FYP") or die ("Couldn't connect to server");
  $CurrentYear = date("Y");
  if (isset($_POST['New']))
  {
    $StaffName = $_POST['Full_Name'];
    $username = $_POST['Username'];
    $StaffID = $_POST['StaffID'];
    $Gender = $_POST['Gender'];
    $TOS = $_POST['TOS'];
    $DSW = $_POST['DSW'];
    $Position = $_POST['Position'];
    $Mobile = $_POST['Mobile'];
    $department = $_POST['department'];
    $Email   = $_POST['Email'];
    $Password1= $_POST['Password1'];
    $Password2= $_POST['Password2'];

    $sql = "SELECT * FROM USERS WHERE Username = '$username'";
    $result = mysqli_query($connection,$sql) or die ("Couldn`t execute query");
    $myrow = mysqli_fetch_row($result);

    if($myrow[2]==$username){
        echo "Username already exist";
    }
    else{
        if (($CurrentYear - $DSW) <= 5){
          $EL    = 25;
          $ML  = 25;
          $AL  = 25;
          $RL  = 25;
        }
        else if (($CurrentYear - $DSW) == 10){
          $EL    = 30;
          $ML  = 30;
          $AL  = 30;
          $RL  = 30;
        }
        else if (($CurrentYear - $DSW) > 10){
          $EL    = 35;
          $ML  = 35;
          $AL  = 35;
          $RL  = 35;
        }
      if ($Position=="Staff"){
        if ($Password1==$Password2)
        {
          $options = [
          'cost' => 12,
      		];
      		$hashed_password = password_hash($Password2, PASSWORD_BCRYPT, $options);

          $sql="INSERT INTO users (StaffName, username, StaffID, Password, Gender, Roles, MobileNum, department, Email, EL, ELbalance, CL, CLbalance, Annual, Annualbalance, OL, OLbalance, TOS, DSW) VALUES
          ('$StaffName', '$username', '$StaffID', '$hashed_password', '$Gender','$Position', '$Mobile' ,'$department',
          '$Email', '$EL', '$EL', '$ML', '$ML', '$AL', '$AL', '$RL', '$RL', '$TOS', '$DSW')";
          $result=mysqli_query($connection, $sql) or die ("Couldn't execute query");

          if ($result)
          {
            echo "success";
          }
          else{
            echo "There was something wrong while inserting your data, Try again";
          }
        }
        else {
          echo "Password Fields do not match";
        }
      }

      else {
        if ($Password1==$Password2)
        {
          $options = [
          'cost' => 12,
          ];
          $hashed_password = password_hash($Password2, PASSWORD_BCRYPT, $options);

          $sql="INSERT INTO users (StaffName, username, StaffID, Password, Gender, Roles, MobileNum, department, Email) VALUES
          ('$StaffName', '$username', '$StaffID', '$hashed_password', '$Gender','$Position', '$Mobile' ,'$department',
          '$Email')";
          $result=mysqli_query($connection, $sql) or die ("Couldn't execute query");

          if ($result)
          {
            echo "success";
          }
          else{
            echo "There was something wrong while inserting your data, Try again";
          }
        }
        else {
          echo "Password Fields do not match";
        }
      }
    }
  }
?>
