<?php
   session_start();
   if (isset($_SESSION['username'])){
     header("location:\FYP\\" . $_SESSION['role'] . "\Records.php");
   }

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <meta name="author" content="Abdul_Azeez">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="\fyp\css\login.css">
    <link rel="icon" href="\fyp\images\Picture1.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
      function myFunction() {
        var x = document.getElementById("myInput");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      }
    </script>
    <style>
    a{
     text-decoration: none;
   }

   .box .inputBox label{
     position: absolute;
     top: -45px;
     left: 30px;
     letter-spacing: 1px;
     padding: 10px 0;
     font-family: 'Vollkorn', cursive;
     font-size: 17px;
     color: #fff;
     pointer-events: none;
     transition: .5s;
   }
   i{
     color: #d3c691;
     margin-right: 15px;
   }

   .box .inputBox input {
     background: none;
     display: block;
     margin: 65px 0 22px 25px;
     text-align: center;
     font-family: 'Vollkorn', cursive;
     letter-spacing: 3px;
     border: 2px solid #d3c77f;
     padding: 14px 25px;
     width: 200px;
     outline: none;
     color: white;
     border-radius: 24px;
     transition: 0.5s;
   }
   .showPassword{
     margin-left: 30px;
     font-family: 'Vollkorn', cursive;
   }
   a button
  {
    background: transparent;
    border:none;
    outline: none;
    color: #000;
    font-family: 'Vollkorn', cursive;
    font-weight: 700;
    background: #d6ca90;
    padding: 14px 50px;
    cursor: pointer;
    border-radius: 24px;
    display: block;
    margin: -87px 170px;
    text-align: center;
    outline: none;
    transition: 0.5s;
  }

   a button:hover{
    background: #e4c98e;
    padding: 14px 55px;
    color: #000;
  }
  #loading_spinner
    {
     display:none;
    }

  .clear-loading {
    text-align: center;
    margin: 0em auto;
    position: relative;
    box-sizing: border-box;
  }

  .spinner {
      width: 80px;
      height: 80px;
  }

  .spinner > span,
  .spinner > span:before,
  .spinner > span:after {
      content: "";
      display: block;
      border-radius: 50%;
      border: 2px solid #d3c77f;
      position: absolute;
      top: 50%;
      left: 50%;
      -webkit-transform: translate(-50%, -50%);
      -moz-transform: translate(-50%, -50%);
      -o-transform: translate(-50%, -50%);
      transform: translate(-50%, -50%);

  }

  .spinner > span {
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      border-left-color: transparent;
      -webkit-animation: effect-2 2s infinite linear;
      -moz-animation: effect-2 2s infinite linear;
      -o-animation: effect-2 2s infinite linear;
      animation: effect-2 2s infinite linear;
  }

  .spinner > span:before {
      width: 75%;
      height: 75%;
      border-right-color: transparent;
  }

  .spinner > span:after {
      width: 50%;
      height: 50%;
      border-bottom-color: transparent;
  }

  @-webkit-keyframes effect-2 {
      from {
          transform: rotate(0deg);
      }
      to {
          transform: rotate(360deg);
      }
  }

  @keyframes effect-2 {
      from {
          transform: rotate(0deg);
      }
      to {
          transform: rotate(360deg);
      }
  }
  </style>
</head>
