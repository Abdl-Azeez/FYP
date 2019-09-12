<?php
  session_start();
  $connection=mysqli_connect("localhost", "root", "", "FYP") or die ("Couldn't connect to server");
    // $connection = mysqli_connect("localhost", "root", "", "FYP") or die ("Couldn't connect to server");
    $user=$_SESSION['username'];
    $lid=intval($_GET['leaveid']);
    $sql= "SELECT request.id as lid, request.StaffName, request.StaffID, users.Email, users.MobileNum, users.Gender, request.Reason, request.status FROM request LEFT JOIN USERS ON USERS.StaffName = REQUEST.StaffName WHERE request.Id=$lid";
    $result= mysqli_query ($connection, $sql) or die ("Could not execute query");
    $myrow= mysqli_fetch_row ($result);

      if (isset ($_POST['UpdateDetail'])){
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $status = $_POST['status'];
        $AdminDate = date('d-m-Y G:i:sa ');

        $sql="UPDATE request SET request.Status = '$status', request.AdminDate = '$AdminDate'  WHERE request.Id=$lid";
        $result= mysqli_query ($connection, $sql) or die ("Could not execute query");

        $sql2="SELECT * from request WHERE request.Id=$lid";
        $result2= mysqli_query ($connection, $sql2) or die ("Could''not execute query");
        $myrow= mysqli_fetch_row ($result2);
        if (($myrow[11]==1) && ($myrow[5]=='1')){
            $sql="UPDATE request, users SET users.ELbalance=users.ELbalance-1, users.ELtaken=users.ELtaken + 1 WHERE request.Id=$lid  AND users.StaffName=request.StaffName AND users.roles='staff'";
            $result= mysqli_query ($connection, $sql) or die ("Could'nt execute query");
            if ($result)
            {
              echo "success";
            }

            else {
              echo "An Error occurred, Leave not processed";
            }
          }

        else if (($myrow[11]==1) && ($myrow[5]=='2')){
              $sql="UPDATE request, users SET users.CLbalance=users.CLbalance-1, users.CLtaken=users.CLtaken+1 WHERE request.Id=$lid  AND users.StaffName=request.StaffName AND users.roles='staff'";
              $result= mysqli_query ($connection, $sql) or die ("Could'nt execute query");
              if ($result)
              {
                echo "success";
              }

              else {
                echo "An Error occurred, Leave not processed";
              }
            }
        else if (($myrow[11]==1) && ($myrow[5]=='3')){
              $sql="UPDATE request, users SET users.Annualbalance=users.Annualbalance-1, users.Annualtaken=users.Annualtaken+1 WHERE request.Id=$lid  AND users.StaffName=request.StaffName AND users.roles='staff'";
              $result= mysqli_query ($connection, $sql) or die ("Could'nt execute query");
              if ($result)
              {
                echo "success";
              }

              else {
                echo "An Error occurred, Leave not processed";
              }
            }
        else if(($myrow[11]==1) && ($myrow[5]=='4')){
              $sql="UPDATE request, users SET users.OLbalance=users.OLbalance-1, users.OLtaken=users.OLtaken+1 WHERE request.Id=$lid  AND users.StaffName=request.StaffName AND users.roles='staff'";
              $result= mysqli_query ($connection, $sql) or die ("Could'nt execute query");
              if ($result)
              {
                echo "success";
              }

              else {
                echo "An Error occurred, Leave not processed";
              }
            }
        else if($myrow[11]==4){
            echo "success";
        }
        else {
            echo "success";
        }
      }
  ?>
