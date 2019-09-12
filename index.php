<!DOCTYPE html>
<html lang="en">
  <head>
    <title>L_M_S | WELCOME PAGE</title>
    <meta name="author" content="Abdul_Azeez">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="\fyp\images\Picture1.png">
    <!-- <link rel="stylesheet" href="\loginfyp\bootstrap.css"> -->
    <link rel="stylesheet" href="\fyp\css\main.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Russo+One|Acme|Josefin+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <style>
    a{
      text-decoration: none;
      color: white;
    }
    a:hover{
      text-decoration: none;
    }
    .carousel-caption{
      right: 0;
      bottom:  0;
      left: 0;
      width: 100%;
      height: 100%;
      background: #0000009e;
      /* background: rgba(100, 100, 100, 0.5); */
    }
    .btn{
      margin-top: 20px;
      padding: 12px;
      background: transparent;
      border-radius: 5px;
      border: white solid 1px;
      transition: linear .5s;
    }
    .btn:hover{
      background: #574c20;
      color: black;
      font-weight: 700;
    }
  </style>
  <body>
    <main>
        <nav class="logo">
          <a href="#">
            <div class="logoImage">
              <img src="\fyp\images\picture1.png" alt="logo">
              <label>LEAVE MANAGEMENT<br> SYSTEM</label>
            </div>
          </a>
          <!-- <div class="login-btn">
            <a href="login.php">LOGIN</a>
          </div> -->
          <a href="login.php">
            <button class="button" data-text="LOGIN">
              <span> SIGN IN  </span>
            </button>
          </a>
        </nav>

        <div id="myCarousel" class="carousel slide" data-ride="carousel">

          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
          </ol>

        <!-- Wrapper for slides -->
          <div class="carousel-inner">

            <div class="item active sliderImage1">
              <div class="carousel-caption">
                <div class="Caption-text">
                  <h3>IIC LEAVE MANAGEMENT</h3>
                  <p>The centralised leave management system</p>
                </div>
              </div>
            </div>

            <div class="item sliderImage2">
              <div class="carousel-caption">
                <div class="Caption-text2">
                  <h3>VITAL FEATURES OF THIS<br> SYSTEM</h3>
                  <a href="About.html">
                    <button class="btn">Click here <i class=" fa fa-caret-right " style="margin-left:15px;"></i><i class=" fa fa-caret-right"></i><i class=" fa fa-caret-right"></i></button>
                  </a>
                  <!-- <p>Application of Leave<br>Cancellation of Leave<br>Viewing of Leave Records</p> -->
                </div>
              </div>
            </div>

            <div class="item sliderImage3">
              <div class="carousel-caption">
                <div class="Caption-text3">
                  <h3>BENEFITS OF THIS SYSTEM</h3>
                  <a href="About.html">
                    <button class="btn">Click here <i class=" fa fa-caret-right " style="margin-left:15px;"></i><i class=" fa fa-caret-right"></i><i class=" fa fa-caret-right"></i></button>
                  </a>
                  <!-- <p>Increase workflow and reduce the chances of losing data <br>To reduce the usage of manual process and to reduce paperwork<br>To fasten the process and make it more effective</p> -->
                </div>
              </div>
            </div>
          </div>

        <!-- Left and right controls -->
          <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
          </a>
      </div>
    </main>
  </body>
</html>
