<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:../index.php');
    }
?>

<!doctype html>
<html lang="en">
  <head>
  	<title>User Submission Update</title>
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


                $id = $_GET['userUpdateSub'];
                $adminmail = $_GET['adminmail'];
                $projectName = $_GET['projectName'];
                $showquery = "select * from task_submission where tid='$id' ";
                $showData = mysqli_query($con,$showquery);
                $username = $_SESSION['username'];

                $result = mysqli_fetch_array($showData);

                if(isset($_POST['submit'])){

                    $file_destination = isset($result['user_task_file']) ? $result['user_task_file'] : "";
                    $description = mysqli_real_escape_string($con , $_POST['description']);

                    if ($_FILES['task_file']['size'] > 0) {
                        $allowedExtensions = array("zip", "pdf", "jpg", "jpeg", "png");
                        $fileExtension = strtolower(pathinfo($_FILES['task_file']['name'], PATHINFO_EXTENSION));
                
                        if (in_array($fileExtension, $allowedExtensions)) {
                            // Handle file upload here (move uploaded file, store file path, etc.)
                            $file_name = $_FILES['task_file']['name'];
                            $file_tmp = $_FILES['task_file']['tmp_name'];
                            $file_destination = "../task_doc/" . $file_name;
                            move_uploaded_file($file_tmp, $file_destination);
                        } else {
                            echo '<script>alert("Invalid file format. Allowed formats: zip, pdf, jpg, jpeg, png");</script>';
                        }
                    }
                        $to = $adminmail;
                        $subject = "$username updated the project task submission";
                        $body = "Hi , \n\n The Project - $projectName  submission has been updated by $username \n\n You can check submitted data on website \n\n Best Regards, \n Team Milestone";
                        $updatequery = "update task_submission set user_task_file='$file_destination', user_remark='$description' where tid='$id'";

                        $query = mysqli_query($con,$updatequery);

                        if($query){
                            if (mail($to, $subject, $body)) {
                                echo '<script>';
                                echo 'var adminMail = "' . $adminmail . '";';
                                echo 'alert("Email successfully sent to " + adminmail);';
                                echo '</script>';
                            } else {
                                echo "Email sending failed...";
                            }
                            $redirectUrl = 'viewtask.php?tid=' . urlencode($id);
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
                            <h4>Update Submission</h4>
                        </center>

                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="formFileMultiple" class="form-label">Current File:</label>
                                <?php
                                    if($result['user_task_file'] != NULL){
                                        echo '<a  href="' . $result['user_task_file'] . '" download>Download File you Submitted</a>';
                                    }else if($result['user_task_file'] == NULL){
                                        echo "You have not uploaded any file yet";
                                    }
                                ?>
                            </div>

                            <div class="mb-3">
                                <label for="formFileMultiple" class="form-label">Upload New File:</label><br>
                                <input class="form-control" type="file" name="task_file" id="formFileMultiple" multiple>
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" name="description" required><?php echo $result['user_remark']; ?></textarea>
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