<?php
  include('session.php');
?>
<html lang="en">
<head>
  <title>L_M_S | RECORDS PAGE</title>
  <style>
  td a i{
    color: black;
    font-size: 16px;
    border-radius: 5px;
    padding: 5px;
    margin-right: 22px;
  }
  .Add
  {
    border: none;
    outline: none;
    color: #000;
    font-family: 'Vollkorn', cursive;
    font-weight: 700;
    background: #96732be8;
    padding: 14px 30px;
    cursor: pointer;
    border-radius: 10px;
    display: block;
    margin: 40px 0 0 70%;
    text-align: center;
    outline: none;
    transition: 0.3s linear;
  }

 .Add:hover{
    background: #d0951dc9;
    padding: 14px 30px;
    color: #000;
  }
  .pagination{
    margin: 0 40px 40px;
    display: inline-block;
    padding-left: 0;
    /* margin: 20px 0; */
    border-radius: 4px;
  }
  .pagination>li {
    display: inline;
}

  .pagination>li:first-child>a, .pagination>li:first-child>span {
    margin-left: 0;
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;}

  .pagination>li:last-child>a, .pagination>li:last-child>span {
        border-top-right-radius: 4px;
        border-bottom-right-radius: 4px;
    }
     .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
    z-index: 0;
}


.pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
    z-index: 3;
    color: #fff;
    cursor: pointer;
    background-color: #8b6516;
    border-color: #493509;
}
.pagination>li>span {
    position: relative;
    float: left;
    padding: 6px 20px;
    margin-left: -1px;
    line-height: 2;
    color: #000000;
    cursor: pointer;
    font-family: Vollkorn;
    font-weight: 600;
    text-decoration: none;
    background-color: #d2951491;
    border: 1px solid #ca9015;
}
    .pagination>li>span:hover{
      background: #8b6516e0;
    }
    .row-group{
      margin: 0 60 20;
    }

    .row-group select{
      background: #d29514;
      width: 120px;
      color: black;
      font-weight: 600;
      font-family: Vollkorn;
      line-height: 3px;
      border: none;
      text-align: center;
    }
    .row-group select:focus{
      background: #d29514;
      color:blue;
    }
    .row-group option{
      background: #d29514;
      color: black;
      font-weight: 600;
    }
</style>
</head>
<body>
  <main>
    <navigation  class='fixed-top navbar navbar-expand-lg navbar-dark nav-style'>
      <div class='logo'>
        <a href=' '>
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
         <li class='nav-item'><a href='\fyp\Admin\Records.php' class="ml-2" style="padding-left:8px;">Requests</a></li>
         <li class='nav-item'><a href='\fyp\Admin\AllRecords.php'>Records</a></li>
         <li class='activated'><a href='\fyp\Admin\Staffs.php' style='color: #121307;'>Staffs</a></li>
         <li class='nav-item'><a href='\fyp\Admin\Superiors.php'>Superiors</a></li>
         <li class='nav-item'><a href='\fyp\Admin\Profile.php'>Profile</a></li>
         <li class='nav-item' style='display:none;'><a href='\fyp\Login.php'>Logout</a></li>
        </ul>
      </div>
      <div class='userProfileImage'>
        <img src='\fyp\images\userPlaceholder.png'>
        <a href='\fyp\Logout.php'>Logout</a>
      </div>
    </navigation>
    <div class='component'>
      <span>Leave Records</span>
      <input type="text" id="searchInput" onkeyup="myFunction()" placeholder="Search staff names.." title="Type a staff name">
      <input type='submit' value='Add New Staff' class="Add">
      <div class="" style="margin-top:50px;">
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
        <?php
          $connection = mysqli_connect("localhost", "root", "", "FYP") or die ("Couldn't connect to server");
          $user=$_SESSION['username'];
          $status=1;
          $Currentdate = date("Y-m-d");
          $sql= "SELECT * FROM request ORDER BY  request.ActionDate desc";
          $result= mysqli_query ($connection, $sql) or die ("Could not execute query");
          $myrow= mysqli_fetch_row ($result);
          echo"
                <table id='Table' class=\"table table-responsive\" style='margin: 0px 60px 70px;'>
                      <thead>
                        <tr>
                          <th>Staff Name</th>
                          <th>Position</th>
                          <th>Department</th>
                          <th>Leave Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>";
          if ($myrow[0]>0){
            do{
              echo"
                      <tbody>
                        <tr
                          <td style='text-transform:uppercase;'>$myrow[1]</td>
                          <td>$myrow[3]</td>
                          <td>$myrow[4]</td>
                          <td style='width: 100px;'>";
                            if(($myrow[11]==2)&&($Currentdate <=$myrow[7])){
                            echo "<span style='color:yellow'>ON LEAVE</span>";
                            }
                            else if(($myrow[11]==2)&&($Currentdate >$myrow[7])){
                            echo "<span style='color:green'> </span>";
                            }
                            else{
                            echo "<span style='color:red'> </span>";
                            }
                            echo"
                          </td>
                          <td><a href='details.php?leaveid=$myrow[0]'><i class=\"fa fa-times\" aria-hidden=\"true\" style='background:red;'></i></a><a href='details.php?leaveid=$myrow[0]'><i class=\"fa fa-pencil\" aria-hidden=\"true\" style='background:green;'></i></a></td>
                        </tr>
                      </tbody>";
              }
              while($myrow= mysqli_fetch_row($result));
              echo"<span class='NotFound' style=\"display:none;\" id=\"noresults\">No Names of Staff has \"<span id=\"qt\"></span>\"</span></table>";
          }
          else {
            echo "<tr><td><span class='NoRecord'>No Records Available</span></td></tr>";
          }
      ?>
        <div class="pagination-container" id="paginationContainer">
          <nav aria-label="Page navigation example">
              <ul class="pagination"></ul>
          </nav>
        </div>
      </div>
    </div>
  </main>
  <script>
      var table = '#Table'
      $('#maxRows').on('change', function(){
          $('.pagination').html('')
          var trnum = 0
          var maxRows = parseInt($(this).val())
          var totalRows = $(table+' tbody tr').length
          $(table+' tr:gt(0)').each(function(){
              trnum++
              if(trnum > maxRows){
                  $(this).hide()
                  // $('#noresults').hide()
              }
              if(trnum <= maxRows){
                  $(this).show()
              }
          })
          if(totalRows > maxRows){
              var pagenum = Math.ceil(totalRows/maxRows)
              for(var i=1;i<=pagenum;){
                  $('.pagination').append('<li data-page="'+i+'">\<span>'+ i++ +'<span class="sr-only">(current)</span></span>\</li>').show()
              }
          }
          $('.pagination li:first-child').addClass('active')
          $('.pagination li').on('click',function(){
              var pageNum = $(this).attr('data-page')
              var trIndex = 0;
              $('.pagination li').removeClass('active')
              $(this).addClass('active')
              $(table+' tr:gt(0)').each(function(){
                  trIndex++
                  if(trIndex > (maxRows*pageNum) || trIndex <= ((maxRows*pageNum)-maxRows)){
                      $(this).hide()
                  } else{
                      $(this).show()
                  }
              })
          })
      })
      $(function(){
          $('table tr:eq(0)').prepend('<th>#</th>')
          var id = 0;
          $('table tr:gt(0)').each(function(){
              id++
              $(this).prepend('<td>'+id+'</td>')
          })
      })
      </script>
</body>
</html>
