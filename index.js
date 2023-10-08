$(".login-form").hide();
$(".login").css("background", "none");
$(".signup").css("border-bottom", "2px solid rgb(133, 76, 230)");

$(".login").click(function(){
  $(".signup-form").hide();
  $(".login-form").show();
  $(".signup").css("color", "#fff");
  $(".login").css("color", "rgb(133, 76, 230)");
  $(".login").css("border-bottom", "2px solid rgb(133, 76, 230)");
  $(".signup").css("border-bottom", "none");
});

$(".signup").click(function(){
  $(".signup-form").show();
  $(".login-form").hide();
  $(".login").css("color", "#fff");
  $(".signup").css("color", "rgb(133, 76, 230)");
  $(".signup").css("border-bottom", "2px solid rgb(133, 76, 230)");
  $(".login").css("border-bottom", "none");
});

$(".btn").click(function(){
  $(".input").val("");
});