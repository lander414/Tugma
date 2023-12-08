
$(document).ready(function(){   
  $('#username').on('input',function(){
    let username = $(this).val();
    if(username.length >=3){
  
      $.ajax({
        url:"../logic/check.php",
        method:"POST",
        data:{username_:username},
        dataType:"text",
        success:function(resp)
        {
          $('#availability').html(resp)
          $("#availability").css("display","block")
        }
      });
    }
    else{
      $("#availability").css("display","none")
    }
    });
  });



