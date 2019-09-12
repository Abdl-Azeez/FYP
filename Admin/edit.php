<?php
  include("session.php");
?>

  <title>L_M_S |User Update</title>
  <link type="text/css" rel="stylesheet" href="/FYP/css/details.css">
  <?php
    include"display.php";
  ?>
</head>
<body>
  <div id="load"></div>
  <main>
    <navigation  class="fixed-top navbar navbar-expand-lg navbar-dark nav-style">
      <div class="logo" style="width: 32%;">
        <a href="\Fyp\index.php">
          <div class="logoImage">
            <img src="\fyp\images\picture1.png" alt="logo">
            <label>LEAVE MANAGEMENT<br> SYSTEM</label>
          </div>
        </a>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="ul-class nav navbar-nav borderEffect">
         <li class="nav-item"><a href="\fyp\Admin\Records.php" class="ml-2" style="padding-left:8px;">Requests</a></li>
         <li class="nav-item"><a href="\fyp\Admin\AllRecords.php">Records</a></li>
         <li class='nav-item'><a href='\fyp\Admin\Users.php'>Users</a></li>
         <li class="nav-item"><a href="\fyp\Admin\Profile.php">Profile</a></li>
         <li class="nav-item" style="display:none;"><a href="\fyp\Login.php">Logout</a></li>
        </ul>
      </div>
      <div class="userProfileImage">
        <img src="<?php if ($myrow[22]==""){echo "\FYP\images\userPlaceholder.png";}else{echo"\FYP\Admin\ProfilePictures\\$myrow[22]";};?>"/>
        <section style="display: inline-flex;justify-content: space-around;">
          <a href="javascript:void(0)" data-activates="dropdown1" class="dropdown-button">
            <i class="material-icons">notifications_none</i>
            <?php
            $connection = mysqli_connect("localhost", "root", "", "FYP") or die ("Couldn't connect to server");
            $user=$_SESSION['username'];
            $sql = "SELECT COUNT(*) AS 'count' FROM request INNER JOIN users ON users.Department = request.Departments WHERE users.username='$user' AND request.Departments=users.Department AND request.status=2";
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
                $sql2 = "SELECT request.Id AS lid, request.StaffName, request.StaffID, request.leaveType, request.DateFrom, request.DateTo, request.Attachment, request.PostingDate, users.Department, request.status FROM request INNER JOIN users ON users.Department = request.Departments
                WHERE users.username='$user' AND request.Departments=users.Department AND request.status=2 ORDER BY request.ActionDate desc";
                $result2= mysqli_query ($connection, $sql2) or die ("Could not execute query");

                if ($result2->num_rows > 0)
                  {
                     while($myrow = $result2->fetch_assoc()){
                    ?>
                <li>
                  <a href="details.php?leaveid=<?php echo $myrow["lid"];?>" name="checked" id="checked">
                    <div class="notification">
                      <div class="notification-icon"><i class="material-icons">done</i>
                      </div>
                      <div class="notification-text"><p>Superior approved <br><b style="text-transform:uppercase;"><?php echo $myrow["StaffName"];?><br/></b>
                        <?php echo $myrow ["StaffID"]?> <br><b><?php if ($myrow["leaveType"]==1)
                              {
                                echo "Emergency Leave";
                              }
                              else if ($myrow["leaveType"]==2)
                              {
                                echo "Casual Leave";
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
                              };?></b><br> applied on <?php echo $myrow["PostingDate"];?></p>
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
    <div class='content'>
      <span>Update Details</span>
      <div class="profileSection">
        <?php
          $connection = mysqli_connect("localhost", "root", "", "FYP") or die ("Couldn't connect to server");
          $user=$_SESSION['username'];
          $lid=intval($_GET['empid']);
          $sql= "SELECT * FROM USERS WHERE users.Id=$lid";
          $result= mysqli_query ($connection, $sql) or die ("Could not execute query");
          $myrow= mysqli_fetch_row ($result);
          ?>
        <form id="UpdateS"  method='post' action="#" onsubmit="return UpdateUse();">
          <input type="hidden" value="UpdateProfile" name="UpdateProfile">
          <div class="form-group">
            <label>Full Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
            <input type="text" name="Full_Name" id="Full_Name" value="<?php echo $myrow[5]?>" style="text-transform:uppercase;" required>
          </div>
          <div class="form-group">
            <label>Username&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
            <input type="text" name="Username" id="Username" value="<?php echo $myrow[2];?>" readonly style="padding: 20px 10px 10px 80px;cursor: not-allowed;">
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Staff-ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <input type="text" name="StaffID" id="StaffID" value="<?php echo $myrow[1];?>" required style="text-transform: uppercase; padding: 20px 10px 10px 80px;cursor: not-allowed;" readonly>
            </div>
            <div class="form-group col-md-6">
              <label>Gender&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <select name="Gender" id="Gender">
                <option value="<?php echo $myrow[7];?>" selected><?php echo $myrow[7];?></option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Mobile-No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <input type="text" name="Mobile" id="Mobile" value="<?php echo $myrow[6];?>" style="padding: 20px 10px 10px 80px;">
            </div>
            <div class="form-group col-md-6">
              <label>Position&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <select name="Position" id="Position" style="padding: 20px 10px 10px 100px;">
                <option value="<?php echo $myrow[8];?>" selected><?php if ($myrow[8]=='Staff'){echo "Lecturer";} else if ($myrow[8]=='Superior'){echo "Deputy Deen";} else if($myrow[8]=='Admin'){echo "Deen";}?></option>
                <option value="Staff">Lecturer</option>
                <option value="Superior">Deputy Deen</option>
                <option value="Admin">Deen</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label>Type of Staff&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
            <select name="TOS" id="TOS" style="padding: 20px 10px 10px 320px;" >
              <option value="<?php echo $myrow[23];?>" selected><?php echo $myrow[23];?></option>
              <option value="Contract">Contract</option>
              <option value="Permanent">Permanent</option>
            </select>
          </div>
          <div class="form-group">
            <label>Date Of Employment&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
            <input type="number" name="DSW" id="DSW" value="<?php echo $myrow[24];?>" required style="padding: 20px 10px 10px 80px; cursor: not-allowed;" readonly>
          </div>
          <div class="form-group">
            <label>Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
            <input type="email" name="Email" id="Email" value="<?php echo $myrow[3];?>" style="text-transform: lowercase; padding: 20px 10px 10px 80px;">
          </div>
          <div class="form-group">
            <label>Department&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
            <select style="padding: 20px 10px 10px 250px;" name="department" id="department">
              <option value="<?php echo $myrow[9];?>" selected><?php echo $myrow[9];?></option>
              <option value="School Of Information Communication Technology">School Of Information Communication Technology</option>
              <option value="School Of Management">School Of Management</option>
              <option value="School Of Social Science">School Of Social Science</option>
              <option value="Center Of Languages">Center Of Languages</option>
            </select>
          </div>
          <div class="form-row" style="margin-left: 20px;">
            <div class="form-group col-md-6">
              <label>Emergency Leaves&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <input type="text" name="EL" id="EL" value="<?php echo $myrow[10];?>" style="padding: 20px 10px 10px 150px; width:90%;">
            </div>
            <div class="form-group col-md-6">
              <label>Taken&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <input type="text" value="<?php echo $myrow[11];?>" style="padding: 20px 10px 10px 150px; width:90%; cursor: not-allowed;cursor: not-allowed;" readonly>
            </div>
          </div>
          <div class="form-row" style="margin-left: 20px;">
            <div class="form-group col-md-6">
              <label>Medical Leaves&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <input type="text" name="ML" id="ML" value="<?php echo $myrow[13];?>" style="padding: 20px 10px 10px 150px; width:90%;">
            </div>
            <div class="form-group col-md-6">
              <label>Taken&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <input type="text" value="<?php echo $myrow[14];?>" style="padding: 20px 10px 10px 150px; width:90%; cursor: not-allowed;" readonly>
            </div>
          </div>
          <div class="form-row" style="margin-left: 20px;">
            <div class="form-group col-md-6">
              <label>Annual Leaves&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <input type="text" name="AL" id="AL" value="<?php echo $myrow[16];?>" style="padding: 20px 10px 10px 150px; width:90%;">
            </div>
            <div class="form-group col-md-6">
              <label>Taken&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <input type="text" value="<?php echo $myrow[17];?>" style="padding: 20px 10px 10px 150px; width:90%; cursor: not-allowed;" readonly>
            </div>
          </div>
          <div class="form-row" style="margin-left: 20px;">
            <div class="form-group col-md-6">
              <label>Replacement Leaves&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <input type="text" name="RL" id="RL" value="<?php echo $myrow[19];?>" style="padding: 20px 10px 10px 150px; width:90%;">
            </div>
            <div class="form-group col-md-6">
              <label>Taken&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <input type="text" value="<?php echo $myrow[20];?>" style="padding: 20px 10px 10px 150px; width:90%; cursor: not-allowed;" readonly>
            </div>
          </div>
          <div class="formbutton">
              <input type="submit" name="submit" value="Update" style="margin: 10px 0px;">
          </div>
        </form>
      </div>
    </div>
  </main>
</body>
<script type="text/javascript">
  function UpdateUse()
  {
    var form= $("#UpdateS")[0];
    var formdata= new FormData(form);
    var r = confirm("You are about to update Staff Detail\n\n Press OK to proceed \nCANCEL to terminate the process");
     if (r == true) {
      $.ajax
      ({
          type:"post",
          url:"/FYP/Admin/UpdateUser.php?empId=<?php echo $myrow[0];?>",
          data:formdata,
          contentType: false,
          processData: false,
          success: function (response) {
            if (response=="success")
              {
                alert("Staff detail as been updated");
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
