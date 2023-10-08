$(".completed").hide();
$(".allPendingTask").css("color", "rgb(133, 76, 230)");
$(".allPendingTask").css("border-bottom", "2px solid rgb(133, 76, 230)");
$(".allPendingTask").css("cursor", "pointer");
$(".allCompTask").css("cursor", "pointer");


$(".allCompTask").click(function(){
  $(".pending").hide();
  $(".completed").show();
  $(".allPendingTask").css("color", "#000");
  $(".allCompTask").css("color", "rgb(133, 76, 230)");
  $(".allCompTask").css("border-bottom", "2px solid rgb(133, 76, 230)");
  $(".allPendingTask").css("border-bottom", "none");
});

$(".allPendingTask").click(function(){
  $(".pending").show();
  $(".completed").hide();
  $(".allCompTask").css("color", "#000");
  $(".allPendingTask").css("color", "rgb(133, 76, 230)");
  $(".allPendingTask").css("border-bottom", "2px solid rgb(133, 76, 230)");
  $(".allCompTask").css("border-bottom", "none");
});

$(".btn").click(function(){
  $(".input").val("");
});