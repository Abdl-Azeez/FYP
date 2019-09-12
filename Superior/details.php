<?php
include "session.php";
?>

  <title>L_M_S |Staff Details</title>
  <link type="text/css" rel="stylesheet" href="\FYP\css\details.css">
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
         <li class='nav-item'><a href='\fyp\Superior\Records.php' class="ml-2" style="padding-left:8px;">Staff Requests</a></li>
         <li class='nav-item'><a href='\fyp\Superior\StaffRecords.php'>Records</a></li>
         <li class='nav-item'><a href='\fyp\Superior\Profile.php'>View Profile</a></li>
         <li class='nav-item'><a href='\fyp\Superior\ChangePassword.php'>Change Password</a></li>
         <li class='nav-item' style='display:none;'><a href='\fyp\Login.php'>Logout</a></li>
        </ul>
      </div>
      <div class='userProfileImage'>
        <img src='<?php if ($myrow[22]==""){echo "\FYP\images\userPlaceholder.png";}else{echo"\FYP\Superior\ProfilePictures\\$myrow[22]";};?>'/>
        <section style="display: inline-flex;justify-content: space-around;">
          <a href="javascript:void(0)" data-activates="dropdown1" class="dropdown-button">
            <i class="material-icons">notifications_none</i>
            <?php
            $connection = mysqli_connect("localhost", "root", "", "FYP") or die ("Couldn't connect to server");
            $user=$_SESSION['username'];
            $sql = "SELECT COUNT(*) AS 'count' FROM request INNER JOIN users ON users.Department = request.Departments WHERE users.username='$user' AND users.roles='Staff' AND request.Departments=users.Department AND request.status=0";
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
                WHERE users.username='$user' AND request.Departments=users.Department AND users.roles='Staff' AND request.status=0 ORDER BY request.PostingDate desc";
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
                      <div class="notification-text"><p><b style="text-transform:uppercase;"><?php echo $myrow["StaffName"];?><br/></b>
                        <?php echo $myrow ["StaffID"]?> <br>applied for <b><?php if ($myrow["leaveType"]==1)
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
                              };?></b> on <br><?php echo $myrow["PostingDate"];?></p>
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
          $sql= "SELECT request.id as lid, request.StaffName, request.StaffID, users.Email, users.MobileNum, users.Gender, request.Reason, request.status, request.Attachment, users.ELtaken, users.ELbalance, users.CLtaken, users.CLbalance, users.Annualtaken, users.Annualbalance, users.OLtaken,
          users.OLbalance, users.Profileimg, request.leaveType, users.TOS FROM request LEFT JOIN USERS ON USERS.StaffName = REQUEST.StaffName WHERE request.Id=$lid";
          $result= mysqli_query ($connection, $sql) or die ("Could not execute query");
          $myrow= mysqli_fetch_row ($result);
        ?>
        <div class="profilePicture">
            <img src='<?php if ($myrow[17]==""){echo "\FYP\images\userPlaceholder.png";}else{echo"\FYP\Staff\ProfilePictures\\$myrow[17]";};?>'/>
            <input type="text" name="Full_Name" value="<?php echo $myrow[1]; ?>" readonly style="text-transform:uppercase;">
        </div>
        <form class="" name="userUpdate" method="post" action="ProcessDetails.php?leaveid=<?php echo $myrow[0];?>" onsubmit="return UpdateDetail();">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Mobile-No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <input type="text" name="Mobile" value="<?php echo $myrow[4]; ?>" readonly>
            </div>
            <div class="form-group col-md-6">
              <label>Gender&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <input type="text" name="Gender" value="<?php echo $myrow[5];?>" readonly style="text-transform:capitalize;">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Staff-ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <input type="text" name="StaffID" value="<?php echo $myrow[2]; ?>" readonly>
            </div>
            <div class="form-group col-md-6">
              <label>Leave Balance&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <input type="text" value="<?php  if ($myrow[18]==1)
                      {
                        echo "$myrow[10]";
                      }
                      else if ($myrow[18]==2)
                      {
                        echo "$myrow[12]";
                      }
                      else if ($myrow[18]==3)
                      {
                        echo "$myrow[14]";
                      }
                      else if ($myrow[18]==4)
                      {
                        echo "$myrow[16]";
                      }
                      else{
                        echo "Null";
                      } ?>" readonly>
            </div>
          </div>
          <div class='form-group'>
            <label>Employee&nbsp;&nbsp;&nbsp;&nbsp;Type&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
            <input type='text' name='TOS' id='TOS' value='<?php echo $myrow[19];?>' required style='cursor:not-allowed;padding: 20px 10px 10px 20px;' readonly>
          </div>
          <?php if ($myrow[8]!=""){ echo"
          <div class=\"form-group\">
            <label>Attachment Uploaded &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
            <a href=\"/fyp/Staff/uploadeddata/$myrow[8]\" target=\"_blank\"><input type=\"text\" value=\"Click to view file\" readonly style=\"color:blue; cursor:pointer;padding: 20px 195px 10px 280px;\"></a>
          </div>
          ";}?>
          <div class="form-group">
            <label>Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
            <input type="email" name="Email" value="<?php echo $myrow[3]; ?>" style="padding-left: 10px;" readonly>
          </div>
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
            <label style="margin-left: 70px;">Staff Reason</label>
            <textarea readonly><?php if ($myrow[6]==""){echo "Not Stated";} else {echo $myrow[6];}  ?></textarea>
          </div>
          <div class="formbutton">
              <?php if ($myrow[7]==0){?>
                <button type="button" class="inpute" data-toggle="modal" data-target=".bd-example-modal-lg">Action</button>
              <?php }?>
              <div class="modal fade bd-example-modal-lg modal-fixed-footer" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content" style="background: #c19e3d; width:90%; border-radius: 20px;">
                    <div class="modal-header">
                      <h5 class="modal-title">Superior Action</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" method="post">
                      <div class="modal-form-content">
                        <select name="status" id="status" required="">
                            <option value="">Choose your action here</option>
                            <option value="2">Recommended</option>
                            <option value="3">Not Recommended</option>
                        </select>
                      </div>
                      <div class="modal-form-content">
                        <textarea name="remark" id="remark"  placeholder="Remark" maxlength="100"></textarea></p>
                      </div>
                      <input type="submit" name="submit" value="Send" onclick="myFunction()">
                    </div>
                  </div>
                </div>
              </div>
            </div>
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
          url:'/FYP/Superior/ProcessDetails.php?leaveid=<?php echo $myrow[0];?>',
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
