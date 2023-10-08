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

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5">

        <?php include('horizontalnavigation.php'); ?>

        <div id="content-container">
            <div class="container">
            <center><h1>Create Project Room</h1></center>
            <form class="container" action="createTaskAddToDb.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <input type="text" class="form-control" Placeholder="Enter Your Project Title" name="title" required>
                    </div>
                    <label>Project Description:</label>
                    <div class="form-floating mb-3">
                      <textarea class="form-control" id="floatingTextarea" name="description" required></textarea>
                    </div>
                    <div class="mb-3">
                      <label for="formFileMultiple" class="form-label">Upload Files:</label></br>
                      <label for="formFileMultiple" class="form-label text-danger">If there are multiple file in project Please make Zip folder And Upload*</label>
                      <input class="form-control" type="file" name="task_file" id="formFileMultiple" multiple>
                    </div>
                    <div class="mb-3">
                      <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="dateInput" class="form-label">Select a Deadline Date:</label>
                        </div>
                        <div class="col-md-3 mb-3">
                            <input type="date" class="form-control" id="dateInput" name="date">
                        </div>
                      </div>
                    </div>
                    <center><button type="submit" class="btn btn-primary mb-4 " name="submit">Create Task</button></center>
            </form>
            </div>
        </div>
	</div>

   




    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>