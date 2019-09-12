  <?php
    include'session.php';
  ?>

  <title>L_M_S | Change Password</title>
  <link rel="stylesheet" href="\fyp\css\ChangePassword.css">
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
         <li class='nav-item'><a href='\fyp\Staff\RECORDS.php' style='padding-left:8px;' class="ml-2">Records</a></li>
         <li class='nav-item'><a href='\fyp\Staff\Request.php'>Apply</a></li>
         <li class='nav-item'><a href='\fyp\Staff\Profile.php'>View Profile</a></li>
         <li class='activated'><a href='' style='color: #121307;'>Change Password</a></li>
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
      <span>Change Password</span>
      <div class="profileSection">
        <form name'' method="post" action="UpdatePass.php" onsubmit="return UpdatePass();">
          <div class="form-group">
            <label>Current Password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
            <input type="password" name="password" id="password"  placeholder="Enter Current Password" minlength="6" pattern=".{6,}" title="Password must contain six or more characters without space" required>
          </div>
          <div class="form-group">
            <label>New Password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
            <input type="password" name="NewPassword1" id="NewPassword1" placeholder="Enter New Password" minlength="6" pattern=".{6,}" title="Password must contain six or more characters without space" required>
          </div>
          <div class="form-group">
            <label>Confirm Password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
            <input type="password" name="NewPassword2" id="NewPassword2"  placeholder="Confirm New Password" minlength="6" pattern=".{6,}" title="Password must contain six or more characters without space" required>
          </div>
          <input type="submit" name="submit" value="Change">
        </form>
    </div>
  </main>
</body>
<script type="text/javascript">
  function UpdatePass()
  {
     var pass=$("#password").val();
     var pass1=$("#NewPassword1").val();
     var pass2=$("#NewPassword2").val();
     var r = confirm("You are about to update your password\n Press OK to proceed \nCANCEL to terminate the process");
      if (r == true) {
        $.ajax
        ({
            type:'post',
            url:'/FYP/Staff/UpdatePass.php',
            data:{
             UpdatePass:"UpdatePass",
             password:pass,
             NewPassword1:pass1,
             NewPassword2:pass2
            },
            success: function (response) {
              if (response=="success")
                {
                  alert("Your password as been updated\n\n \t\t\tYou will be redirected to the login page");
                  setTimeout(function(){
                    window.location.href= "/FYP/logout.php";
                  }, 1000)
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
