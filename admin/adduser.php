<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:../index.php');
    }
?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Create Task</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">
  </head>
  <body>
		
	<div class="wrapper d-flex align-items-stretch">
		<?php include('verticalnavigation.php'); ?>
        <div id="content" class="p-4 p-md-5">

        <?php include('horizontalnavigation.php'); ?>

        <div id="content-container">
        <?php 
            include('../common/connection.php');
            if(isset($_POST['submit'])){
                $num = $_GET["task_room_code"];
                $tid = $_GET['tid'];
                $to = $_POST['email'];
                $username = $_SESSION['username']; 

                $subject = "Code for joining Project/task";
                $message = "Hi, \n \n $username is sharing a Project/task code with you. \n Project Code - $num \n\n Note: To join the project in website click on join task and then paste the code If you do not have an account on Milestone, create an account using the same email id. \n\n Best Regards\nTeam Milestone";

                $retval = mail($to, $subject, $message);

                if ($retval == true) {
                    header("Location: viewtask.php?tid=" . $tid);
                    exit;
                } else {
                    header("Location: viewtask.php?tid=" . $tid);
                    exit;
                }
            }
        ?>








            <center>
                    <div class="container otpwidth">
                        <h1 style="color:green"; class="pb-3">Send Invitation Code</h1>
                        <form action="" method="post">
                                <div class="mb-3">
                                    <input type="email" class="form-control" Placeholder="Enter Mail id" class="input" name="email" required>
                                </div>
                            <center><button type="submit" class="btn btn-primary mb-4 " name="submit">Send Invitation</button></center>
                        </form>
                    </div>
            </center>
        </div>
	</div>

   




    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>