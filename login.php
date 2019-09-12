<?php
   include"session.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <title>L_M_S | LOGIN</title>
  </head>
  <body>
    <div id="wrapper">

      <div class="box">
          <!-- <p id="loading_spinner"><img src="/FYP/images/loader.gif"></p> -->
          <h2>LOGIN</h2>
          <div id="loading_spinner" class="clear-loading spinner">
        		<span></span>
        	</div>
          <form method="post" action="do_login.php" onsubmit="return do_login();">
            <div class="inputBox">
                  <label><i class="fa fa-user" aria-hidden="true"></i>Username <font color='orange'>  *</font></label>
                  <input type="text" id="username" name="username"  placeholder="Enter User Name" required >

              </div>
            <div class="inputBox">
                  <label><i class="fa fa-unlock-alt" aria-hidden="true"></i>Password <font color='orange'>  *</font></label>
                  <input type="password" name="password" id="myInput" placeholder="Enter Password" pattern=".{6,}" title="A password of lenght 6" required>

              </div>
              <div class="showPassword">
                <input id="check3" name="check3" type="checkbox" value="show password" onclick="myFunction()">
      					<label class="check" for="check3">Show password</label>
                <a class="forgotPass" href="RetrievePassword.php">Forgot Password?</a>
              </div>
              <center>
                  <input type="submit" name="submit" value="Login">
              </center>
          </form>
      </div>
    </div>
  </body>
  <script type="text/javascript">
    function do_login()
    {
       var email=$("#username").val();
       var pass=$("#myInput").val();
       if(email!="" && pass!="")
       {
        $("#loading_spinner").css({"display":"block"});
        $.ajax
        ({
            type:'post',
            url:'do_login.php',
            data:{
             do_login:"do_login",
             username:email,
             password:pass
            },
            success:function(response) {
              if((response=="Staff") || (response=="Admin") || (response=="Superior"))
              {
                console.log("/FYP/" + response + "/Records.php")
                setTimeout(function(){
                  window.location.href= "/FYP/" + response + "/Records.php";
                }, 1000)
              }
              else
              {
                $("#loading_spinner").css({"display":"none"});
                alert(response);
              }
            }
        });
       }

       else
       {
        alert("Please Fill All The Details");
       }

       return false;
    }
  </script>
</html>
