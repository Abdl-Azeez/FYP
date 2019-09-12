<?php
include "session.php";
    $lid=intval($_GET['leaveid']);
		$checkNum=1;
    $sql2 = "SELECT users.StaffName, request.status, users.Profileimg FROM request INNER JOIN users ON users.StaffName = request.StaffName WHERE users.username='$user' AND users.roles='Staff'";
  	$result2= mysqli_query ($connection, $sql2) or die ("Could not execute query");
    $myrow= mysqli_fetch_row ($result2);
    if ($myrow[1]>0){
      $sql3="UPDATE request SET Checked=$checkNum WHERE StaffName= '$myrow[0]' AND request.Id=$lid";
      $result3= mysqli_query ($connection, $sql3) or die ("Could not execute query");
    }
?>
  <title>L_M_S |Details</title>
  <link type="text/css" rel="stylesheet" href="/FYP/css/details.css">
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
          <li class="nav-item"><a href="\fyp\Staff\Records.php" class="ml-2">Records</a></li>
          <li class="nav-item"><a href="\fyp\Staff\Request.php">Apply</a></li>
          <li class="nav-item"><a href="\fyp\Staff\Profile.php">View Profile</a></li>
          <li class="nav-item"><a href="\fyp\Staff\ChangePassword.php">Change Password</a></li>
          <li class="nav-item" style="display:none;"><a href="\fyp\Login.php">Logout</a></li>
        </ul>
      </div>
      <div class='userProfileImage'>
        <img src='<?php if ($myrow[2]==""){echo "\FYP\images\userPlaceholder.png";}else{echo"\FYP\Staff\ProfilePictures\\$myrow[2]";};?>'/>
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
    <div class='content'>
      <span>Staff Details</span>
      <div class="profileSection">
        <?php
          $connection = mysqli_connect("localhost", "root", "", "FYP") or die ("Couldn't connect to server");
          $user=$_SESSION['username'];
          $lid=intval($_GET['leaveid']);
          $sql= "SELECT request.id as lid, request.StaffName, request.StaffID, request.Attachment, request.PostingDate, users.Gender, request.Reason, request.status, request.leaveType, users.ELtaken, users.ELbalance, users.CLtaken, users.CLbalance, users.Annualtaken, users.Annualbalance, users.OLtaken, users.OLbalance,
          request.ActionDate, request.AdminDate, users.Profileimg FROM request LEFT JOIN USERS ON USERS.StaffName = REQUEST.StaffName WHERE request.Id=$lid";
          $result= mysqli_query ($connection, $sql) or die ("Could not execute query");
          $myrow= mysqli_fetch_row ($result);
          ?>
        <div class="profilePicture">
            <img src='<?php if ($myrow[19]==""){echo "\FYP\images\userPlaceholder.png";}else{echo"\FYP\Staff\ProfilePictures\\$myrow[19]";};?>'/>
            <input type="text" name="Full_Name" value="<?php echo $myrow[1]; ?>" readonly style="text-transform:uppercase;">
        </div>
        <form class="" name="userUpdate" method="post" action="ProcessDetails.php?leaveid=<?php echo $myrow[0];?>" onsubmit="return UpdateDetail();">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Leave Type&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <input type="text" value="<?php if ($myrow[8]==1)
                    {
                      echo "Emergency Leave";
                    }
                    else if ($myrow[8]==2)
                    {
                      echo "Medical Leave";
                    }
                    else if ($myrow[8]==3)
                    {
                      echo "Annual Leave";
                    }
                    else if ($myrow[8]==4)
                    {
                      echo "Replacement Leave";
                    }
                    else{
                      echo "$myrow[8]";
                    }; ?>" readonly>
            </div>
            <div class="form-group col-md-6">
              <label>Leave Balance&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <input type="text" value="<?php  if ($myrow[8]==1)
                      {
                        echo "$myrow[10]";
                      }
                      else if ($myrow[8]==2)
                      {
                        echo "$myrow[12]";
                      }
                      else if ($myrow[8]==3)
                      {
                        echo "$myrow[14]";
                      }
                      else if ($myrow[8]==4)
                      {
                        echo "$myrow[16]";
                      }
                      else{
                        echo "Null";
                      } ?>" readonly>
            </div>
          </div>
          <div class="form-group">
            <label>Date Applied &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
            <input type="text" value="<?php echo $myrow[4];?>" readonly>
          </div>
          <?php if ($myrow[3]!=""){ echo"
          <div class=\"form-group\">
            <label>Attachment Uploaded &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
            <a href=\"/fyp/Staff/uploadeddata/$myrow[3]\" target=\"_blank\"><input type=\"text\" value=\"Click to view file\" readonly style=\"color:blue; cursor:pointer;padding: 20px 195px 10px 280px;\"></a>
          </div>
          ";}
          if (($myrow[7]==2)||($myrow[7]==3)){echo "
          <div class=\"form-group\">
            <label>Superior Action Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
            <input type=\"text\" value=\"$myrow[17]\" readonly>
          </div>
          ";}?>
          <?php if (($myrow[7]==1)||($myrow[7]==4)){echo "
          <div class=\"form-group\">
            <label>Admin Action Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
            <input type=\"text\" value=\"$myrow[18]\" readonly>
          </div>
          ";}?>
          <div class="form-group">
            <label>Status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
            <?php   if($myrow[7]==0)
             {
              echo "<section style=\"padding: 5px 280px;\"><span style='background: #8b6516; color: Yellow'>Pending</span>";
               }
              if($myrow[7]==1){
              echo "<section style=\"padding: 5px 280px;\"><span style='color: green'>Approved</span>";
              }
              if($myrow[7]==2){
              echo "<section style=\"padding: 5px 214px;\"><span style='color: blue'>Waiting for Admin Approval</span>";
              }
              if($myrow[7]==3){
              echo "<section style=\"padding: 5px 264px;\"><span style='color: red'>Not Approved</span>";
              }
              if($myrow[7]==4){
              echo "<section style=\"padding: 5px 264px;\"><span style='color: red'>Not Approved by Admin</span>";
              }
              ?>  </section>
          </div>
          <div class="form-group" style="margin-top:40px;">
            <label style="margin-left: 70px;">Reason for Leave</label>
            <textarea readonly><?php if ($myrow[6]==""){echo "Not Stated";} else {echo $myrow[6];} ?></textarea>
          </div>
        </form>
      </div>
    </div>
  </main>
</body>
<script type="text/javascript">
  function UpdateDetail()
  {
     var status=$("#status").val();
     var remark=$("#remark").val();

      $.ajax
      ({
          type:'post',
          url:'/FYP/Staff/ProcessDetails.php?leaveid=<?php echo $myrow[0];?>',
          data:{
           UpdateDetail:"UpdateDetail",
           status:status,
           remark:remark
          },
          success: function (response) {
            if (response=="success")
              {
                alert("Action Recorded");
                window.location.reload();
              }
            else{
              alert(response);
            }
          }
      });
      // alert("Password successfully Updated");

     return false;
  }
</script>
</html>
