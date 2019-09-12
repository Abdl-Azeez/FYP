  <?php
    include'session.php';
  ?>
  <title>L_M_S | REQUEST PAGE</title>
  <link rel="stylesheet" href="\fyp\css\Request.css">
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
         <li class='nav-item'><a href='\fyp\Staff\Records.php' class="ml-3" style="padding-left:8px;">Records</a></li>
         <li class='activated'><a href='\fyp\Staff\Request.php' style='color: #121307;'>Apply</a></li>
         <li class='nav-item'><a href='\fyp\Staff\Profile.php'>View Profile</a></li>
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
      <span>Leave Application Form</span>
      <?php   $sql="SELECT * FROM users WHERE username='$user' AND roles='Staff'";
        $result= mysqli_query ($connection, $sql) or die ("Could not execute query");
        $myrow= mysqli_fetch_row ($result);
      ?>
      <form id="RequestForm" action="#" enctype="multipart/form-data" method="post">
        <input type="hidden" value="ProcessRequest" name="ProcessRequest">
        <div class="form-group" style="display:flex;">
          <label style="position:absolute; margin:25px 0px 0px 3px;">Full Name</label>
          <input type="text" id="StaffName" name="StaffName" value="<?php echo $myrow[5]; ?>" readonly style="text-transform: uppercase; letter-spacing:1px; cursor:not-allowed;">
        </div>
        <div class="form-group" >
          <input type="text" id="departments" name="departments" value="<?php echo $myrow[9]; ?>" readonly style="letter-spacing:1px;" hidden>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Staff ID</label>
            <input type="text" id="StaffID" name="StaffID" value="<?php echo $myrow[1]; ?>" readonly style="text-transform: uppercase; letter-spacing:3px; cursor:not-allowed;">
          </div>
          <div class="form-group col-md-6">
            <label>Staff Position</label>
            <input type="text" id="Position" name="Position" value="<?php echo $myrow[8];?>" readonly style=" cursor:not-allowed;">
          </div>
        </div>
        <div class="form-group" style="display:flex;">
          <label style="position:absolute; margin:16px 0px 0px 3px;">Type of Leave</label>
          <select id="leaveType" name="leaveType" required style="padding: 15px 0px 12px 180px;">
              <option selected>Choose Leave Type...</option>
              <option value="1">Emergency Leave</option>
              <option value="2">Medical Leave</option>
              <option value="3">Annual Leave</option>
              <option value="4">Replacement Leave</option>
              <option value="Special Leave">Special Leave</option>
              <option value="Maternity/Paternity Leave">Maternity/Paternity Leave</option>
          </select>
        </div>
        <div class="form-row" style="margin-bottom: -2rem;">
          <div class="form-group col-md-6">
            <label>Leave From</label>
            <input type="date" id="DateFrom" name="DateFrom" required style="padding: 20px 0px 10px 55px;">
          </div>
          <div class="form-group col-md-6" style="flex-flow:column;">
            <label>Leave To</label>
            <input type="date" id="DateTo" name="DateTo" required style="padding: 20px 0px 10px 55px;">
          </div>
        </div>
        <textarea id="Reason" name="Reason" placeholder="Reason for the leave..." maxlength="120"></textarea>
        <center>
          <div class="form-group" style="margin:40px 0 0 0;">
            <label style="text-transform:capitalize; font-family: 'Vollkorn', cursive;border: none;">Attach Suplementary document &nbsp; (Optional) : </label>
          </div>
          <!-- <div class="form-row" style="margin-bottom: 40px;"> -->
            <div class="form-group col-md-6" style="margin-bottom: 40px;">
              <input type="file" name="fileToUpload" id="fileToUpload" style="padding:20px 0px;">
            </div>
            <!-- <div class="form-group col-md-6">
              <button type="submit" name="Upload">Upload</button>
            </div> -->
          <!-- </div> -->
        </center>
        <div class="formbutton">
          <div style="display:flex; ">
            <input type="submit" name="submit" value="Send">
            <i class="fa fa-paper-plane-o mr-4" aria-hidden="true"></i>
          </div>
          <input type="reset" value="Clear">
        </div>
      </form>
    </div>
  </main>


  <script type="text/javascript">
      $(document).ready(function(){
        $("#RequestForm").submit(function () {
          return process_form();
        })
      })

      var process_form = function()
      {
        // var StaffName=$("#StaffName").val();
        // var StaffID=$("#StaffID").val();
        // var Position=$("#Position").val();
        // var departments=$("#departments").val();
        // var leaveType=$("#leaveType").val();
        // var DateFrom=$("#DateFrom").val();
        // var DateTo=$("#DateTo").val();
        // var Reason=$("#Reason").val();
        // var fileToUpload=$("#fileToUpload").val();

        var form = $("#RequestForm")[0];
        var formdata= new FormData(form);

        // var data={
        //   ProcessRequest:"ProcessRequest",
        //   StaffName:StaffName,
        //   StaffID:StaffID,
        //   Position:Position,
        //   departments:departments,
        //   leaveType:leaveType,
        //   DateFrom:DateFrom,
        //   DateTo:DateTo,
        //   Reason:Reason,
        //   image:image
        //  }

         $.ajax({
           type: 'post',
           url: '/FYP/Staff/ProcessRequest.php',
           data: formdata,
           contentType: false,
           processData: false,
           success: function (response) {
             if (response=="success")
               {
                 alert("Your request as been sent");
                 window.location.reload();
               }
             else{
               alert(response);
             }
           },
           error:function(e){
              console.log("There is an error in posting");
           }
       });
       return false;
      }
  </script>

</body>
</html>
