<?php
  session_start();
  $connection=mysqli_connect("localhost", "root", "", "FYP") or die ("Couldn't connect to server");
  $user=$_SESSION['username'];
  $sql="SELECT * FROM users WHERE username='$user' AND roles='Staff'";
  $result=mysqli_query($connection, $sql) or die ("Could not execute query");
  $myrow=mysqli_fetch_row($result);

  if (isset($_POST['StaffName']))
    {
      $StaffName = $_POST['StaffName'];
      $StaffID = $_POST['StaffID'];
      $Position = $_POST['Position'];
      $departments = $_POST['departments'];
      $leaveType   = $_POST['leaveType'];
      $DateFrom    = $_POST['DateFrom'];
      $DateTo  = $_POST['DateTo'];
      $Reason  = $_POST['Reason'];
      $Currentdate = date("Y-m-d");

      if(($DateFrom < $Currentdate) || ($DateFrom > $DateTo))
      {
          echo "Check the date selection. To-Date should be greater than From-Date";
      }
      else
      {
        $errors= array();
        $file_name = $_FILES['fileToUpload']['name'];
        $file_size =$_FILES['fileToUpload']['size'];
        $file_tmp =$_FILES['fileToUpload']['tmp_name'];
        $file_type=$_FILES['fileToUpload']['type'];
        $tmp = explode('.', $file_name);
        $file_ext = strtolower(end($tmp));
        $expensions= array("jpeg","jpg","png","pdf", "docx", "doc", "");

        if(in_array($file_ext,$expensions)=== false){
           $errors[]="please make sure you choose a document or picture file.";
        }

        if($file_size > 5097152){
           $errors[]='File size must be less than 5 MB';
        }

        if(empty($errors)==true){
           move_uploaded_file($file_tmp,"uploadeddata/".$file_name);

        } else{
           print_r($errors);
        }
        if ($errors ==false){
          if (($leaveType==1) && ($myrow[10]!=0))
          {
            $sql="INSERT INTO request (StaffName, StaffID, Position, departments, leaveType, DateFrom, DateTo, Reason, Attachment) VALUES ('$StaffName', '$StaffID', '$Position', '$departments', '$leaveType', '$DateFrom', '$DateTo', '$Reason', '$file_name')";
            $result=mysqli_query($connection, $sql) or die ("Couldn't execute query");

            if ($result)
            {
              echo "success";
            }
            else{
              echo "There was something wrong while inserting your data, Try again";
            }
          }

          else if (($leaveType==1) && ($myrow[10]==0)){
            echo "You have exceeded all your Emergency Leaves";
          }

          else if (($leaveType==2) && ($myrow[13]!=0))
          {
            $sql="INSERT INTO request (StaffName, StaffID, Position, departments, leaveType, DateFrom, DateTo, Reason, Attachment) VALUES ('$StaffName', '$StaffID', '$Position', '$departments', '$leaveType', '$DateFrom', '$DateTo', '$Reason', '$file_name')";
            $result=mysqli_query($connection, $sql) or die ("Couldn't execute query");

            if ($result)
            {
              echo "success";
            }
            else{
              echo "There was something wrong while inserting your data, Try again";
            }
          }

          else if (($leaveType==2) && ($myrow[13]==0))
          {
            echo "You have exceeded all your Medical Leaves";
          }

          else if (($leaveType==3) && ($myrow[16]!=0))
          {
            $sql="INSERT INTO request (StaffName, StaffID, Position, departments, leaveType, DateFrom, DateTo, Reason, Attachment) VALUES ('$StaffName', '$StaffID', '$Position', '$departments', '$leaveType', '$DateFrom', '$DateTo', '$Reason', '$file_name')";
            $result=mysqli_query($connection, $sql) or die ("Couldn't execute query");

            if ($result)
            {
              echo "success";
            }
            else{
              echo "There was something wrong while inserting your data, Try again";
            }
          }

          else if (($leaveType==3) && ($myrow[16]==0))
          {
            echo "You have exceeded all your Annual Leaves";
          }

          else if (($leaveType==4) && ($myrow[19]!=0))
          {
            $sql="INSERT INTO request (StaffName, StaffID, Position, departments, leaveType, DateFrom, DateTo, Reason, Attachment) VALUES ('$StaffName', '$StaffID', '$Position', '$departments', '$leaveType', '$DateFrom', '$DateTo', '$Reason', '$file_name')";
            $result=mysqli_query($connection, $sql) or die ("Couldn't execute query");

            if ($result)
            {
              echo "success";
            }
            else{
              echo "There was something wrong while inserting your data, Try again";
            }
          }

          else if (($leaveType==4) && ($myrow[19]==0))
          {
            echo "You have exceeded all your Replacement Leaves";
          }
        }
      }
    }
?>
