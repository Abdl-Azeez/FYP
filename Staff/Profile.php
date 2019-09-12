  <?php
    include'session.php';
  ?>

  <title>L_M_S | PROFILE</title>
  <link rel="stylesheet" href="\fyp\css\Profile.css">
  <?php
    include'display.php';
  ?>
</head>
<body>
  <div id="load"></div>
  <main>
    <navigation  class='fixed-top navbar navbar-expand-lg navbar-dark nav-style'>
      <div class='logo'>
        <a href='\Fyp\index.php'>
          <div class='logoImage'>
            <img src='\fyp\images\picture1.png' alt='logo'>
            <label>LEAVE MANAGEMENT<br> SYSTEM</label>
          </div>
        </a>
      </div>
			<button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
  				<span class='navbar-toggler-icon'></span>
			</button>
				<div class='collapse navbar-collapse' id='navbarNav'>

        <ul class='ul-class nav navbar-nav borderEffect'>
         <li class='nav-item'><a href='\fyp\Staff\Records.php' class="ml-2">Records</a></li>
         <li class='nav-item'><a href='\fyp\Staff\Request.php'>Apply</a></li>
         <li class='activated'><a href='' style='color: #121307;'>View Profile</a></li>
         <li class='nav-item'><a href='\fyp\Staff\ChangePassword.php'>Change Password</a></li>
         <li class='nav-item' style='display:none;'><a href='\fyp\Login.php'>Logout</a></li>
        </ul>
			</div>
      <div class='userProfileImage'>
        <img src='<?php if ($myrow[22]==""){echo "\FYP\images\userPlaceholder.png";}else{echo"\FYP\Staff\ProfilePictures\\$myrow[22]";};?>'/>
        <section style="display: inline-flex;justify-content: space-around;">
          <a href="javascript:void(0)" data-activates="dropdown1" class="dropdown-button">
            <i class="material-icons">notifications_none</i>
            <?php
            $connection = mysqli_connect("localhost", "root", "", "FYP") or die ("Couldn't connect to server");
            $isread=0;
            $user=$_SESSION['username'];
            $sql = "SELECT COUNT(*) AS 'count' FROM request INNER JOIN users ON users.StaffName = request.StaffName WHERE users.username='$user' AND users.roles='Staff' AND request.checked=0 AND request.status>0";
            $result= mysqli_query ($connection, $sql) or die ("Could not execute query");
            $row = mysqli_fetch_assoc($result);
            $count = $row['count'];
            ?>
            <span class="badge"><?php echo $count;?></span>
          </a>
          <ul id="dropdown1" class="dropdown-content" style="width: 46px; position: absolute;top: 0px;left: 1034.75px;opacity: 1; display: none;">
            <li class="notificatoins-dropdown-container">
              <ul>
                <li class="notification-drop-title">Notifications</li>
                <?php
                $user=$_SESSION['username'];
                $sql2 = "SELECT request.Id AS lid, request.StaffName, request.StaffID, request.leaveType, request.DateFrom, request.DateTo, request.Attachment, request.PostingDate, users.Department, request.status FROM request INNER JOIN users ON users.StaffName = request.StaffName
                WHERE users.username='$user' AND users.roles='Staff' AND  request.checked=0 AND request.status>0 ORDER BY request.PostingDate desc";
                $result2= mysqli_query ($connection, $sql2) or die ("Could not execute query");

                if ($result2->num_rows > 0)
                  {
                     while($myrow = $result2->fetch_assoc()){
                    ?>
                <li>
                  <a href="details.php?leaveid=<?php echo $myrow["lid"];?>" name="checked" id="checked">
                    <div class="notification">
                      <div class="notification-icon"><i class="material-icons">done</i></div>
                      <div class="notification-text"><p><b><?php if ($myrow["leaveType"]==1)
                            {
                              echo "Emergency Leave";
                            }
                            else if ($myrow["leaveType"]==2)
                            {
                              echo "Medical Leave";
                            }
                            else if ($myrow["leaveType"]==3)
                            {
                              echo "Annual Leave";
                            }
                            else if ($myrow["leaveType"]==4)
                            {
                              echo "Replacement Leave";
                            }
                            else{
                              echo $myrow["leaveType"];
                            };?><br/></b> applied on <?php echo $myrow["PostingDate"];?></p><span>as been attended to by <?php if (($myrow["status"]==2)||($myrow["status"]==3)){echo "Superior";} else{echo "Admin";}?></span>
                          </div>
                        </div>
                          <?php }}?>

                  </a>
                </li>
              </ul>
            </li>
          </ul>
          <a class="logout" href='\fyp\Logout.php'>Logout</a>
        </section>
      </div>
		</navigation>
    <div class='component'>
      <span>My Profile</span>
      <?php
        $connection = mysqli_connect("localhost", "root", "", "FYP") or die ("Couldn't connect to server");
        // $StaffName=$_POST['StaffName'];
        $user=$_SESSION['username'];
        $sql= "SELECT * FROM users WHERE username='$user' AND roles='staff'";
        $result= mysqli_query ($connection, $sql) or die ("Could not execute query");
        $myrow= mysqli_fetch_row ($result);
        echo "
          <form id=\"Profile\" enctype=\"multipart/form-data\" class='profileSection' method='post' action=\"#\" onsubmit=\"return Profile();\">
            <input type=\"hidden\" value=\"UpdateProfile\" name=\"UpdateProfile\">
            <div class='profilePicture'>
              <a href=\"";if ($myrow[22]==""){echo "\FYP\images\userPlaceholder.png";}else{echo"\FYP\Staff\ProfilePictures\\$myrow[22]";};echo"\" target=\"_blank\">
                <img src='";if ($myrow[22]==""){echo "\FYP\images\userPlaceholder.png";}else{echo"\FYP\Staff\ProfilePictures\\$myrow[22]";};echo"'/>
              </a>
              <span>Change Profile Picture</span>
              <input type=\"file\" name=\"profimage\" id=\"profimage\" style=\"padding:20px 0px;\">
            </div>
            <div class='sideform'>
              <div class='form-group'>
                <label>Full Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                <input type='text' name='Full_Name' id='Full_Name' value='$myrow[5]' style='text-transform:uppercase;' required>
              </div>
              <div class='form-group'>
                <label>Username&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                <input type='text' name='Username' id='Username' value='$myrow[2]' readonly style='cursor:not-allowed' required>
              </div>
              <div class='form-group'>
                <label>Staff-ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                <input type='text' name='StaffID' id='StaffID' value='$myrow[1]' required style='text-transform: uppercase;cursor:not-allowed' readonly>
              </div>
              <div class='form-group'>
                <label>Employee Type&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                <input type='text' name='TOS' id='TOS' value='$myrow[23]' required style='cursor:not-allowed' readonly>
              </div>
              <div class='form-group'>
                <label>Department&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                <input type='text' name='Department' id='Department' value='";
                if ($myrow[9]=="School Of Information Communication Technology"){echo "S.I.C.T";}
                else if ($myrow[9]=="School Of Management"){echo "S.O.M";}
                else if ($myrow[9]=="School Of Social Science"){echo "S.O.S";}
                else if ($myrow[9]=="Center Of Languages"){echo "C.E.L";}
                else{echo "$myrow[9]";}
                echo"' readonly style='cursor:not-allowed'>
              </div>
              <div class='form-group'>
                <label>Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                <input type='email' name='Email' id='Email' value='$myrow[3]' required style='text-transform: lowercase;'>
              </div>
              <div class='form-group'>
                <label>Mobile-No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                <input type='text' name='Mobile' id='Mobile' value='$myrow[6]' size='12'>
              </div>
              <div class='form-group'>
                <label>Gender&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                <input type='text' name='Gender' id='Gender' value='$myrow[7]'>
              </div>
              <div class='formbutton'>
                  <input type='submit' name='submit' value='Update'>
              </div>
            </div>
          </form>";
          if ($myrow[22]!=""){echo "
          <form id=\"DeleteForm\" action=\"#\" method=\"post\"  onsubmit=\"return rowdel();\" style=\"margin: 0px 0px 0px 22px;\">
            <input type=\"hidden\" value=\"ProcessDelete\" name=\"ProcessDelete\">
            <div onclick=\"return rowdel();\" style=\"position: absolute; top: 128%; right: 0%; left: 24%; max-width:20%;\">
                <input type=\"submit\" class=\"Add\" name=\"submit\" value=\"Remove Picture\" style=\"padding: 7px 78px!important; color: #eee; font-weight: normal;\">
                <i class=\"material-icons\" style=\"color: #dfeaeb;cursor: pointer;position: absolute;top: 13%;right: 21%;\" title=\"Delete User\">delete_forever</i>
            </div>
          </form>
          ";}?>
    </div>
  </main>
</body>
<?php
  $connection = mysqli_connect("localhost", "root", "", "FYP") or die ("Couldn't connect to server");
  $user=$_SESSION['username'];
  $status=1;
  $Currentdate = date("Y-m-d");
  $sql= "SELECT * FROM users WHERE roles='Staff' AND username='$user'";
  $result= mysqli_query ($connection, $sql) or die ("Could not execute query");
  $myrow= mysqli_fetch_row ($result);
?>
<script type="text/javascript">
  function rowdel(){
    if(confirm("Are you sure you want to remove your profile picture?")){
      $.ajax
      ({
          type:'post',
          url:'/FYP/Staff/Picturedel.php?empid=<?php echo "$myrow[0]";?>',
          data:{
           ProcessDelete:"ProcessDelete",
          },
          success: function (response) {
            if (response=="success")
              {
                alert("Picture successfully removed");
                window.location.reload();
              }
            else{
              alert(response);
            }
          }
      });
    }
    else {
      alert("Action Discard");
    }
     return false;
   }

  function Profile()
  {
     // var Full_Name=$("#Full_Name").val();
     // var Username=$("#Username").val();
     // var StaffID=$("#StaffID").val();
     // var Email=$("#Email").val();
     // var Mobile=$("#Mobile").val();
     // var Gender=$("#Gender").val();
     var form= $("#Profile")[0];
     var formdata= new FormData(form);
     var r = confirm("You are about to update your profile\n Press OK to proceed \nCANCEL to terminate the process");
      if (r == true) {
        $.ajax
        ({
            type:'post',
            url:'/FYP/Staff/UpdateProfile.php',
            data:formdata,
            contentType: false,
            processData: false,
            success: function (response) {
              if (response=="success")
                {
                  alert("Your profile as been updated");
                  window.location.reload();
                }
              else{
                alert(response);
              }
            }
        });
      }
      else {
          alert("Process terminated");
          window.location.reload();
      }

     return false;
  }
</script>
</html>
