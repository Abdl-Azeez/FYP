<?php
session_start();

if (isset($_POST['do_login']))
{
    $connection = mysqli_connect("localhost", "root", "","FYP") or die ("couldn`t connect to server");

    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM USERS WHERE Username = '$username'";
    $result = mysqli_query($connection,$sql) or die ("Couldn`t execute query");
    $myrow = mysqli_fetch_row($result);
      $count = mysqli_num_rows($result);

      if($count == 1){
        if(password_verify($password, $myrow[4]))
         {
              //return true;
              $_SESSION['valid'] = true;
              $_SESSION['timeout'] = time();
              $_SESSION['username'] = $username;
              $_SESSION['role'] = $myrow[8];
              echo $_SESSION['role'];
         }
         else
         {
              //return false;
              echo "Wrong User Details";
         }
      }
      else {
        echo "Incorrect username or password!!!";

      }
  }

  else{
    echo "Not Connected";
  }
?>
