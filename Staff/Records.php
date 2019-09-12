<?php
  include'session.php';
?>
  <title>L_M_S | RECORDS PAGE</title>
  <link rel="stylesheet" href="\FYP\css\modal.css">
  <?php
    include'display.php';
  ?>
</head>
<body>
  <div id="load"></div>
  <main>
    <navigation  class="fixed-top navbar navbar-expand-lg navbar-dark nav-style">
      <div class="logo">
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
         <li class="activated"><a href="" style="color: #121307;" class="ml-2">Records</a></li>
         <li class="nav-item"><a href="\fyp\Staff\Request.php">Apply</a></li>
         <li class="nav-item"><a href="\fyp\Staff\Profile.php">View Profile</a></li>
         <li class="nav-item"><a href="\fyp\Staff\ChangePassword.php">Change Password</a></li>
         <li class="nav-item" style="display:none;"><a href="\fyp\Login.php">Logout</a></li>
        </ul>
			</div>
      <div class="userProfileImage">
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
    <div class="component">
      <span>Leave Records</span>
      <input type="text" id="searchInput" onkeyup="myFunction()" placeholder="Search for Leave type.." title="Type in Leave type">
      <input type="text" value="WELCOME &nbsp <?php echo $_SESSION["username"]; ?> !" readonly class="user">
      <div style="display: flex;justify-content: space-around;width: 100%;margin-top: 50px;">
        <div class="row-group" id="row-group">
          <select name="state" id="maxRows" class="form-control" style="width:150px;">
            <option value="5000">Show All</option>
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="75">75</option>
            <option value="100">100</option>
          </select>
        </div>
        <form method="post" action="generate_pdf.php">
          <div class="formbutton">
          <button type="button" class="inpute" data-toggle="modal" data-target=".bd-example-modal-lg">Print Records</button>
          <div class="modal fade bd-example-modal-lg modal-fixed-footer" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="margin-left: 22% !important; padding:0px !important;">
            <div class="modal-dialog modal-lg">
              <div class="modal-content" style="background: #c19e3d; width:60%; border-radius: 20px;">
                <div class="modal-header">
                  <h5 class="modal-title">Sort Record to Generate</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <?php
                  $connection = mysqli_connect("localhost", "root", "", "FYP") or die ("Couldn't connect to server");
                  $user=$_SESSION['username'];
                  $query="SELECT * FROM users WHERE users.username='$user'";
                  $outcome= mysqli_query ($connection, $query) or die ("Could not execute query");
                  $rowselected= mysqli_fetch_row ($outcome);
                  ?>
                <div class="modal-body" method="post">
                  <div class="modal-form-content">
                    <select id="empleave" name="empleave" required>
                        <option selected>Choose Leave Type...</option>
                        <option value="1">Emergency Leave</option>
                        <option value="2">Medical Leave</option>
                        <option value="3">Annual Leave</option>
                        <option value="4">Replacement Leave</option>
                        <option value="Special Leave">Special Leave</option>
                        <option value="Maternity/Paternity Leave">Maternity/Paternity Leave</option>
                        <option value="5">All</option>
                    </select>
                  </div>
                  <input type="submit" name="Formsubmit" value="Print">
                </div>
              </div>
            </div>
          </div>
        </div>
        </form>
      </div>
        <?php
          $connection = mysqli_connect("localhost", "root", "", "FYP") or die ("Couldn't connect to server");
          // $StaffName=$_POST['StaffName'];
          $user=$_SESSION['username'];
          $sql= "SELECT * FROM users WHERE username='$user' AND roles='Staff'";
          $result= mysqli_query ($connection, $sql) or die ("Could not execute query");
          $myrow= mysqli_fetch_row ($result);
          $requestName=$myrow[5];

          $sql= "SELECT request.Id,request.leaveType,request.Reason,request.DateFrom,request.DateTo,request.Status,request.Remark, users.El,users.ElTaken,users.Elbalance,users.Cl,users.Cltaken,users.Clbalance,users.Annual,users.Annualtaken,users.Annualbalance,users.Ol,users.Oltaken,users.Olbalance, request.ActionDate FROM request INNER JOIN users ON
          users.StaffName = request.StaffName WHERE request.StaffName='$requestName' AND users.roles='Staff' ORDER BY request.PostingDate desc";
          $result= mysqli_query ($connection, $sql) or die ("Could not execute query");
          $myrow= mysqli_fetch_row ($result);
          echo"
            <table id='Table' class=\"table-responsive\" style='margin-top:20px;'>
                <thead>
                  <tr>
                    <th>Leaves Type</th>
                    <th>Total Leaves</th>
                    <th>Leaves Taken</th>
                    <th>Leave Taken<br>{From}</th>
                    <th>Leave Taken<br>{To}</th>
                    <th>Status</th>
                    <th>Superior Remarks</th>
                    <th>Detail</th>
                  </tr>
                </thead>
                <tbody>";
            if ($myrow[0]>0){
              do{
                echo"

                  <tr>
                    <td style='width: 130px;'>"; if ($myrow[1]==1)
                          {
                            echo "Emergency Leave";
                          }
                          else if ($myrow[1]==2)
                          {
                            echo "Medical Leave";
                          }
                          else if ($myrow[1]==3)
                          {
                            echo "Annual Leave";
                          }
                          else if ($myrow[1]==4)
                          {
                            echo "Replacement Leave";
                          }
                          else{
                            echo "$myrow[1]";
                          }echo"</td>
                    <td>"; if ($myrow[1]==1)
                            {
                              echo "$myrow[7]";
                            }
                            else if ($myrow[1]==2)
                            {
                              echo "$myrow[10]";
                            }
                            else if ($myrow[1]==3)
                            {
                              echo "$myrow[13]";
                            }
                            else if ($myrow[1]==4)
                            {
                              echo "$myrow[16]";
                            }
                            else{
                              echo "Null";
                            }
                    echo"</td>
                    <td>"; if ($myrow[1]==1)
                            {
                              echo "$myrow[8]";
                            }
                            else if ($myrow[1]==2)
                            {
                              echo "$myrow[11]";
                            }
                            else if ($myrow[1]==3)
                            {
                              echo "$myrow[14]";
                            }
                            else if ($myrow[1]==4)
                            {
                              echo "$myrow[17]";
                            }
                            else{
                              echo "Null";
                            }
                    echo"</td>
                    <td style='width: 120px;'>$myrow[3]</td>
                    <td style='width: 120px;'>$myrow[4]</td>
                    <td style='font-weight: 600; width: 130px;'>";
                        if($myrow[5]==0)  {
                        echo "<span style='color: Yellow'>Pending</span>";
                         }
                        if($myrow[5]==1){
                        echo "<span style='color: green'>Approved</span>";
                        }
                        if($myrow[5]==2){
                        echo "<span style='color: blue'>Waiting for Admin Approval</span>";
                        }
                        if($myrow[5]==3){
                        echo "<span style='color: red'>Not Recommended by Superior</span>";
                        }
                        if($myrow[5]==4){
                        echo "<span style='color: red'>Not Approved by Admin</span>";
                        }
                        echo"
                    </td>
                    <td>"; if($myrow[5]==0)  {
                              echo "<span>Waiting for Superior Action</span>";
                           }
                          else if (($myrow[5]!=0)&&($myrow[6]==""))
                          {
                              echo "<span>No Remark Stated</span>";
                          }
                          else {
                              echo "$myrow[6]<br><br><span style='color: '>ON: $myrow[19]</span>";
                          } echo "
                    </td>
                    <td><a href='details.php?leaveid=$myrow[0]'><input type='submit' name='view' value='view'></a></td>
                  </tr>
                </tbody>";
              }
              while ($myrow = mysqli_fetch_row($result) );
              echo"<span class='NotFound' style=\"display:none;\" id=\"noresults\">No Names of Leave type has \"<span id=\"qt\"></span>\"</span></table>";
          }
          else {
            echo "<tbody><tr><td colspan='10'><span class='NoRecord'>No Records Available</span></td></tr></tbody></table>";
          }
        ?>
      <div class="pagination-container" id="paginationContainer">
        <nav aria-label="Page navigation example">
            <ul class="pagination"></ul>
        </nav>
      </div>
    </div>
    <?php if ($count>0){?>
      <div id="boxes">
        <div style="top: 199.5px; left: 551.5px; display: none; display: flex; flex-direction: column; align-items: center;" id="dialog" class="window">
          <div id="popuptext">
            <p>You have &nbsp <?php echo "$count";?> &nbsp unchecked <?php if ($count==1){echo "notification";} else {echo "notifications";}?></p>
          </div>
          <div id="popupfoot"> <span class="discard">Close</span></div>
        </div>
        <div style="width: 1478px; font-size: 32pt; color:white; height: 602px; display: none; opacity: 0.8;" id="mask"></div>
      </div>
    <?php } ?>
  </main>
  <?php include 'pagination.php';?>
</body>
</html>
