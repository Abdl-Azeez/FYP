<script type="text/javascript">
  //change class on scroll
    $(function(){
      $(window).scroll(function() {
          if($(window).scrollTop() >= 100) {
            $('navigation').removeClass('nav-style');
            $('navigation').addClass('scrolled');
          }

          else {
              $('navigation').removeClass('scrolled');
              $('navigation').addClass('nav-style');
          }
        });
    });
  //Load function
    document.onreadystatechange = function () {
        setTimeout(function(){
           document.getElementById('load').style.visibility="hidden";
        },500);
    }
  
  //Search function
  $('.dropdown-trigger').dropdown();
  function myFunction() {
    var q = document.getElementById("searchInput");
    var v = q.value.toLowerCase();
    var rows = document.getElementsByTagName("tr");
    var on = 0;
    for ( var i = 0; i < rows.length; i++ ) {
      var fullname = rows[i].getElementsByTagName("td")[1];
      // fullname = fullname[0].innerHTML.toLowerCase();
      if ( fullname ) {
          if (fullname.innerHTML.toLowerCase().indexOf(v) > -1)  {
          rows[i].style.display = "";
          on++;
        } else {
          rows[i].style.display = "none";
        }
      }
    }
    var n = document.getElementById("noresults");
    if ( on == 0 && n ) {
      n.style.display = "";
      document.getElementById("qt").innerHTML = q.value;
      document.getElementById("row-group").style.display="none";
      document.getElementById("paginationContainer").style.display="none";
    } else {
      n.style.display = "none";
      document.getElementById("row-group").style.display="";
      document.getElementById("paginationContainer").style.display="";
    }
  }
  // Notifications popup
  $(document).ready(function() {

        var id = '#dialog';

        //Get the screen height and width
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();

        //Set heigth and width to mask to fill up the whole screen
        $('#mask').css({'width':maskWidth,'height':maskHeight});

        //transition effect
        $('#mask').fadeIn(500);
        $('#mask').fadeTo("slow",0.9);

        //Get the window height and width
        var winH = $(window).height();
        var winW = $(window).width();

        //Set the popup window to center
        $(id).css('top',  winH/2-$(id).height()/2);
        $(id).css('left', winW/2-$(id).width()/2);

        //transition effect
        $(id).fadeIn(2000);

      //if close button is clicked
      $('.window .discard').click(function (e) {
        //Cancel the link behavior
        e.preventDefault();

        $('#mask').hide();
        $('.window').hide();
      });

      //if mask is clicked
      $('#mask').click(function () {
        $(this).hide();
        $('.window').hide();
      });

  });

  </script>
