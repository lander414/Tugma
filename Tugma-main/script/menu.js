
$(document).on('click', function() {
  $(".menus").hide();
});


$(".menu-button").click(function(e){
  e.stopPropagation()
  var menus = $(".menus").eq(0);
  menus.slideToggle();
})

$(".bulb-button").click(function(){
  $("html").toggleClass("dark-mode");
  $.cookie('dark-mode', $("html").hasClass("dark-mode"), { expires: 10, path: '/' });
});
$(document).ready(function() {
  if ($.cookie('dark-mode') === 'true') {
    $("html").addClass("dark-mode");
  }
});

isLoginVisible = false;
isSignupvisible = false;

$("#log-in-button").click(function(){
$("#login").slideToggle();
isLoginVisible = !isLoginVisible;
if(isSignupvisible){
  $("#signup").slideToggle();
  isSignupvisible = !isSignupvisible;
}

});
$("#sign-up-button").click(function(){
  $("#signup").slideToggle();
  isSignupvisible = !isSignupvisible;
  if(isLoginVisible){
    $("#login").slideToggle();
    isLoginVisible= !isLoginVisible;
  }
  });