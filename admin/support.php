<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:../index.php');
    }
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Update Project</title>
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

            <div class="container-fluid form">
            <div class="container update-form">
                <div class="upload-form">
                    <center>
                        <h4>Write To us</h4>
                    </center>

                    <form action="send_email.php" method="post">
                        <div class="mb-3">
                            <input type="text" class="form-control" Placeholder="Enter Your Name" name="name" value="<?php echo $_SESSION['username']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" Placeholder="Enter Your email" name="email" value = "<?php echo $_SESSION['email']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="">Message</label>
                            <textarea class="form-control" name="message" required></textarea>
                        </div>
                        <center><button type="submit" class="btn btn-primary mb-4 " name="submit">Send</button></center>
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