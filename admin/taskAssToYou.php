<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:../index.php');
    }
?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Task Assign to you</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  </head>
  <body>
		
	<div class="wrapper d-flex align-items-stretch">
		<?php include('verticalnavigation.php'); ?>

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5">

        <?php include('horizontalnavigation.php'); ?>

        <div id="content-container">
        <?php

            include('../common/connection.php');
            ?>

            <div class="container">
                <div class="d-flex p-lg-4">
                        <div class="allPendingTask "><h5>Task Pending</h5></div>
                        <div class="allCompTask ml-3"><h5>Task Completed</h5></div>
                </div>
                <div class="pending">
                    <div class="album py-5 bg-body-tertiary">
                        <div class="container">
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                                <?php 
                                $uid = $_SESSION['uid'];
                                $selectQuery = "SELECT * FROM task WHERE user_freelancer_id = '$uid' and final_project_status = 'Pending'";
                                $query = mysqli_query($con, $selectQuery);

                                
                                if (mysqli_num_rows($query) > 0) {
                                    while ($result = mysqli_fetch_array($query)) {
                                    ?>
                                    <div class="col">
                                        <div class="card shadow-sm">
                                            <div class="card-body pt-md-4">
                                            <div class="mb-2" style="float:right; "><h6 style="color:orange;">Status : Pending</h6></div>
                                                <div class = "mt-4">
                                                    <h4><?php echo $result['task_name']; ?></h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="btn-group">
                                                            <a class="btn btn-sm btn-outline-secondary" href="viewtask.php?tid=<?php echo $result['tid']; ?>&data-page=viewtask">View</a>
                                                        </div>
                                                        <small class="text-body-secondary text-warning">Deadline:  <?php echo $result['deadline']; ?></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                    <?php
                                    }
                                } else {
                                    // Display a message when no tasks are assigned
                                    echo '<div class="col"><p>No tasks assigned to you.</p></div>';
                                }
                                ?> 
                            </div>
                        </div>
                    </div>
                </div>


            <div class="draft">
                <div class="album py-5 bg-body-tertiary">
                    <div class="completed">

                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

                        <?php 
                                $uid = $_SESSION['uid'];
                                $selectQuery = "SELECT * FROM task WHERE user_freelancer_id = '$uid' and final_project_status = 'Completed'";
                                $query = mysqli_query($con, $selectQuery);

                                
                                if (mysqli_num_rows($query) > 0) {
                                    while ($result = mysqli_fetch_array($query)) {
                                    ?>
                                    <div class="col">
                                        <div class="card shadow-sm">
                                            <div class="card-body pt-md-4">
                                            <div class="mb-2" style="float:right; "><h6 style="color:green;">Status : Completed</h6></div>
                                                <div class = "mt-4">
                                                    <h4><?php echo $result['task_name']; ?></h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="btn-group">
                                                            <a class="btn btn-sm btn-outline-secondary" href="viewtask.php?tid=<?php echo $result['tid']; ?>&data-page=viewtask">View</a>
                                                        </div>
                                                        <small class="text-body-secondary text-warning">Deadline:  <?php echo $result['deadline']; ?></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                    <?php
                                    }
                                } else {
                                    // Display a message when no tasks are assigned
                                    echo '<div class="col"><p>No tasks Completed assigned to you.</p></div>';
                                }
                                ?>
                        </div>
                        </div>
                </div>
           </div>
            </div>

            <?php
            ?>
        </div>
	</div>

   



    <script src="js/tabs.js"></script>                             
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>