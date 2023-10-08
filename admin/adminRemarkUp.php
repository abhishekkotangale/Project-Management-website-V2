<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:../index.php');
    }
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Update Remark</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">
  </head>
  <body>
		
	<div class="wrapper d-flex align-items-stretch">
		<?php include('verticalnavigation.php'); ?>

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5">

        <?php include('horizontalnavigation.php'); ?>

        <div id="content-container">
            <?php

            include '../common/connection.php';


            $adminRemarkid = $_GET['adminRemarkUp'];
            $adminRemarkShowquery = "select * from task_submission where tid='$adminRemarkid' ";
            $adminRemarkshowData = mysqli_query($con,$adminRemarkShowquery);

            $adminRemarkResult = mysqli_fetch_array($adminRemarkshowData);

            if(isset($_POST['submit'])){

                
                $description = mysqli_real_escape_string($con , $_POST['description']);
                
                    $updatequery = "update task_submission set admin_remark='$description' where tid='$adminRemarkid'";

                    $query = mysqli_query($con,$updatequery);

                    if($query){
                        $redirectUrl = 'viewtask.php?tid=' . urlencode($adminRemarkid);
                        header('Location: ' . $redirectUrl);
                    }else{
                        echo "not inserted";
                    }
                }

            ?>

            <div class="container-fluid form">
                <div class="container update-form">
                    <div class="upload-form">
                        <center>
                            <h4>Update Submission(Remark)</h4>
                        </center>

                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <textarea class="form-control" name="description" required><?php echo $adminRemarkResult['admin_remark']; ?></textarea>
                            </div>
                            <center><button type="submit" class="btn btn-primary mb-4 " name="submit">Update</button></center>

                        </form>
                    </div>
                </div>
            </div>
        </div>
	</div>

   




    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>