<?php
  session_start();
	$connection=mysqli_connect("localhost", "root", "", "FYP") or die ("Couldn't connect to server");
  if (isset ($_POST['UpdateProfile'])){
  	$Full_Name = $_POST['Full_Name'];
  	$Username = $_POST['Username'];
  	$StaffID = $_POST['StaffID'];
  	$Email = $_POST['Email'];
  	$Mobile = $_POST['Mobile'];
  	$Gender =$_POST['Gender'];
    $user=$_SESSION['username'];

    $errors= array();
    $file_name = $_FILES['profimage']['name'];
    $file_size =$_FILES['profimage']['size'];
    $file_tmp =$_FILES['profimage']['tmp_name'];
    $file_type=$_FILES['profimage']['type'];
    $tmp = explode('.', $file_name);
    $file_ext = strtolower(end($tmp));
    $expensions= array("jpeg","jpg","png");

    if(in_array($file_ext,$expensions)=== false){
       $errors[]="extension not allowed, please choose pictures in jpg, png or jpeg only.";
    }

    if($file_size > 5097152){
       $errors[]='File size must be less than 5 MB';
    }

    if(empty($errors)==true){
       move_uploaded_file($file_tmp,"ProfilePictures/".$file_name);

    } else{
       print_r($errors);
    }

  	$sql="UPDATE users SET StaffID = '$StaffID' , Username= '$Username' , Profileimg ='$file_name', Email ='$Email', StaffName= '$Full_Name', MobileNum= '$Mobile', Gender= '$Gender' WHERE username='$user' AND roles='staff'";
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
