$(document).ready(function(){
  $("#search").keyup(function(){
      var value = $(this).val();
    
      if(value.trim() !== ""){
          $.ajax({
              url: "../logic/search.php",
              method: "POST",
              data: {value: value},
              success: function (response) {
                $("#result").html(response);
                $("#result").css("display", "block");
              }
          });
      } else {
          $("#result").html("");
          $("#result").css("display", "none"); 
      }
  });
});