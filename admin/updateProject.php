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
        <?php

            include '../common/connection.php';

            $id = $_GET['updateProject'];
            $showquery = "SELECT * FROM task WHERE tid='$id'";
            $showData = mysqli_query($con, $showquery);

            if (!$showData) {
                die("Error: " . mysqli_error($con));
            }

            $result = mysqli_fetch_array($showData);

            if (isset($_POST['submit'])) {
                $title = mysqli_real_escape_string($con, $_POST['title']);
                $description =  $_POST['description'];
                $deadline = $_POST['date'];

                // Get the current file path from the database
                $file_destination = isset($result['task_doc']) ? $result['task_doc'] : "";

                if ($_FILES['task_file']['size'] > 0) {
                    $allowedExtensions = array("zip", "pdf", "jpg", "jpeg", "png");
                    $fileExtension = strtolower(pathinfo($_FILES['task_file']['name'], PATHINFO_EXTENSION));

                    if (in_array($fileExtension, $allowedExtensions)) {
                        // Handle file upload here (move uploaded file, store file path, etc.)
                        $file_name = $_FILES['task_file']['name'];
                        $file_tmp = $_FILES['task_file']['tmp_name'];
                        $file_destination = "../user_task_sub_doc/" . $file_name;
                        move_uploaded_file($file_tmp, $file_destination);
                    } else {
                        echo '<script>alert("Invalid file format. Allowed formats: zip, pdf, jpg, jpeg, png");</script>';
                    }
                }

                
                $updatequery = "UPDATE task SET task_name='$title', task_details='$description', task_doc='$file_destination', deadline='$deadline' WHERE tid='$id'";

                $query = mysqli_query($con, $updatequery);

                if ($query) {
                    if ($result['user_freelancer_id']!=NULL) {
                        $user_id = $result['user_freelancer_id'];
                        $getMailIdQuery = "select * from users where uid='$user_id'";
                        $getMailshowData = mysqli_query($con, $getMailIdQuery);
                        $getUserData = mysqli_fetch_array($getMailshowData);
                        $username = $_SESSION['username'];
                        $mail_id = $getUserData['email'];
                        $user = $getUserData['username'];
                
                        $to = $mail_id;
                        $subject = "the project- $title details has been updated";
                        $body = "Hi $user, \n\n The Project - $title  has been updated by $username \n\n You can check updated data on website \n\n Best Regards, \n Team Milestone";
                        if (mail($to, $subject, $body)) {
                            echo '<script>';
                            echo 'var userMail = "' . $mail_id . '";';
                            echo 'alert("Email successfully sent to " + userMail);';
                            echo '</script>';
                        } else {
                            echo "Email sending failed...";
                        }
                    }
                    $redirectUrl = 'viewtask.php?tid=' . urlencode($id) . '&data-page=viewtask';
                    header('Location: ' . $redirectUrl);
                    exit;
                } else {
                    echo "Update failed";
                }
            }
        ?>

            <div class="container-fluid form">
            <div class="container update-form">
                <div class="upload-form">
                    <center>
                        <h4>Update Task</h4>
                    </center>

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <input type="text" class="form-control" Placeholder="Enter Your Blog Title" name="title" value="<?php echo $result['task_name'];?>" required>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" name="description" required><?php echo $result['task_details']; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="formFileMultiple" class="form-label">Current File:</label>
                            <?php
                                if($result['task_doc'] != NULL){
                                    echo '<a  href="' . $result['task_doc'] . '" download>Download Project Document</a>';
                                }else if($result['task_doc'] == NULL){
                                    echo "You have not uploaded any file yet";
                                }
                            ?>
                        </div>

                    <!-- Allow users to upload a new file if needed -->
                    <div class="mb-3">
                        <label for="formFileMultiple" class="form-label">Upload New File:</label><br>
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