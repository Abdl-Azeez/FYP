<?php
  $connection = mysqli_connect("localhost", "root", "", "FYP") or die ("Couldn't connect to server");

  $del=$_POST['del'];

  if (isset ($_POST['del'])){

    $sql="DELETE FROM users WHERE Id='$del'";
    $result= mysqli_query ($connection, $sql) or die ("Could'nt execute query");
      if ($result)
        {
          header("location: users.php");
        }

        else {
          echo "An Error occurred, Leave not processed";
        }
      }
?>
