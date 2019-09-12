<script>

  $('.Print').click(function(){
      var printkon = document.getElementById('Table');
      var winkon = window.open("","","width=900,height=650");
      winkon.document.write(printkon.outerHTML);
      winkon.document.close();
      winkon.focus();
      winkon.print();
      winkon.close();
  });

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
