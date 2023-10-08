<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:../index.php');
    }
?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Join Project</title>
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

            if (isset($_POST['submit'])) {
                $code = mysqli_real_escape_string($con, $_POST['class_code']);
                $freelancer_id = $_SESSION['uid'];

                // Check if the class code exists in the task table
                $sql = "SELECT * FROM task WHERE task_room_code = '$code'";
                $query = mysqli_query($con, $sql);

                if (!$query) {
                    echo "Query failed: " . mysqli_error($con);
                } else if (mysqli_num_rows($query) == 0) {
                    echo "No Class found";
                } else {
                    $row = mysqli_fetch_assoc($query);

                
                    if ($row['user_freelancer_id'] == $freelancer_id) {
                        echo '<script>alert("You Already joined the Project room");</script>';
                    } else if ($row['user_freelancer_id'] != NULL) {
                        echo '<script>alert("Project room is full");</script>';
                    } else {
                        
                        $updatequery = "UPDATE task SET user_freelancer_id='$freelancer_id' WHERE task_room_code='$code'";
                        $upquery = mysqli_query($con, $updatequery);

                        if ($upquery) {
                            $admin_id = $row['admin_uid'];
                            $mailFetchQuery = "select * from users where uid='$admin_id'";
                            $mailQuery = mysqli_query($con, $mailFetchQuery);
                            if ($mailQuery) {
                                $adminRow = mysqli_fetch_assoc($mailQuery);
                                $adminUsername = $adminRow['username'];
                                $adminMail = $adminRow['email'];

                                $projectName = $row['task_name'];
                                $name = $_SESSION['username'];

                                $to = $adminMail;
                                $subject = "$name joined the project - $projectName";
                                $body = "Hi $adminUsername, \n\n The Project room - $projectName  has been joined by $name \n\n If this user is fraud then you can exit this user from class \n\n Best Regards, \n Team Milestone";
                                

                                if (mail($to, $subject, $body)) {
                                    echo '<script>';
                                    echo 'var adminMail = "' . $adminMail . '";';
                                    echo 'alert("Email successfully sent to " + adminMail);';
                                    echo '</script>';
                                } else {
                                    echo "Email sending failed...";
                                }



                            }
                            header("Location: viewtask.php?tid=" . $row['tid']);
                            exit();
                        } else {
                            echo "Update failed: " . mysqli_error($con);
                        }
                    }
                }
            }
        ?>



        <center>
            <div id="content-container">
                <h1>Join Project</h1>
                <form class="container" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <input type="number" class="form-control" placeholder="Enter Code" name="class_code" class="input" required>
                        </div>
                        <center><button type="submit" class="btn btn-primary mb-4 " name="submit">Join Project</button></center>
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