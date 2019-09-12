<?php
  $connection = mysqli_connect("localhost", "root", "", "FYP") or die ("Couldn't connect to server");
  $lid=intval($_GET['empid']);

  if (isset ($_POST['ProcessDelete'])){

    $sql="UPDATE Users SET Profileimg ='' WHERE Id=$lid";
    $result= mysqli_query ($connection, $sql) or die ("Could'nt execute query");
      if ($result)
        {
          echo "success";
        }

        else {
          echo "An Error occurred, Leave not processed";
        }
      }
?>
