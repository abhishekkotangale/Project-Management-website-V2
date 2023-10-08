<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:../index.php');
    }
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Setting</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">

    <style>
      @media (max-width: 767px) {
        .img{
          width:150px;
          height:150px;
        }
        .form{
          margin-top:20px;
          display:block;
          width:100%;
          margin:auto;
        }
        .file_form{
        width:200px !important;
       }
      }
    </style>
    
  </head>
  <body>

  <?php
  include('../common/connection.php');
      $id = $_SESSION['uid'];
     $sql = "SELECT * FROM users WHERE uid = $id";
     $userSettingResult = mysqli_query($con, $sql);
     if (!$userSettingResult) {
         echo "User retrieval failed: " . mysqli_error($con);
     } else {
         $userSettingRow = mysqli_fetch_assoc($userSettingResult);
     }
  ?>
		
	<div class="wrapper d-flex align-items-stretch">
		<?php include('verticalnavigation.php'); ?>


        <div id="content" class="p-4 p-md-5">

        <?php include('horizontalnavigation.php'); ?>

        <div id="content-container">
            <div class="container mb-5">
            <div class="row">
              <div class="col-lg-6 col-md-6">
                <center>
                  <img src="<?php echo $userSettingRow['profile'];?>" class="img"alt="" srcset="" width="250px" height="250px" style="border-radius: 50%;">
                </center>
              </div>
              <div class="col-lg-6 col-md-6" style="margin-top:95px; float:right;" class="form">
                  <form action="changeavatar.php" method="post" enctype="multipart/form-data">
                    <div class="d-flex">
                      <div><input type="file" name="avatar" class="form-control file_form" style="width:240px;"></div>
                      <div>
                        <button type="submit" class="btn btn-primary mb-4 " name="submit">Change Photo</button>
                      </div>
                    </div>
                  </form>
              </div>
            </div>
            </div>

            
            <div class="container text-center m-2  ">
              <center>
              <div class="card shadow-lg rounded p-4" style="width:80%;">
                  <h1 class="pt-lg-4">Change Password</h1>
                  <form action="changepass.php" method="POST">
                    <div class="mb-3">
                      <label for="oldPass" class="form-label">Old Password</label>
                      <input type="password" class="form-control" id="oldPass" name="oldPass" required>
                    </div>
                    <div class="mb-3">
                      <label for="inputPassword1" class="form-label">New Password</label>
                      <input type="password" class="form-control" id="inputPassword1" name="newpass" required>
                    </div>
                    <div class="mb-3">
                        <label for="inputPassword2" class="form-label">Re-Enter New Password</label>
                        <input type="password" class="form-control" id="inputPassword2" name="cnewpass" required>
                      </div>
                      <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                  </form>
              </div>
              </center>
            </div>


        </div>
	</div>

   




    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>