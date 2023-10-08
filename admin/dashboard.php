<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:../index.php');
    }
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Dashboard</title>
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
        
        include('../common/connection.php'); 

        $uid = $_SESSION['uid'];
        //Task Assign to you --- User, Employee, Freelancer
        // Query to count total tasks assigned to you
        $countAssignedQuery = "SELECT COUNT(*) as total_assigned FROM task WHERE user_freelancer_id = '$uid'";
        $resultAssigned = mysqli_query($con, $countAssignedQuery);
        $rowAssigned = mysqli_fetch_assoc($resultAssigned);
        $totalAssigned = $rowAssigned['total_assigned'];

        // Query to count total tasks completed
        $countCompletedQuery = "SELECT COUNT(*) as total_completed FROM task WHERE final_project_status = 'Completed' AND user_freelancer_id = '$uid'";
        $resultCompleted = mysqli_query($con, $countCompletedQuery);
        $rowCompleted = mysqli_fetch_assoc($resultCompleted);
        $totalCompleted = $rowCompleted['total_completed'];

        // Query to count total tasks pending
        $countPendingQuery = "SELECT COUNT(*) as total_pending FROM task WHERE final_project_status = 'Pending' AND user_freelancer_id = '$uid'";
        $resultPending = mysqli_query($con, $countPendingQuery);
        $rowPending = mysqli_fetch_assoc($resultPending);
        $totalPending = $rowPending['total_pending'];


        //Task Assign By you --- Admin, Project Manager
        // Query to count total tasks assigned by you
        $countAssignedQueryAdmin = "SELECT COUNT(*) as total_assigned_by_admin FROM task WHERE admin_uid = '$uid'";
        $resultAssignedAdmin = mysqli_query($con, $countAssignedQueryAdmin);
        $rowAssignedAdmin = mysqli_fetch_assoc($resultAssignedAdmin);
        $totalAssignedAdmin = $rowAssignedAdmin['total_assigned_by_admin'];

        // Query to count total tasks completed
        $countCompletedQueryAdmin = "SELECT COUNT(*) as total_completed_Admin FROM task WHERE final_project_status = 'Completed' AND admin_uid = '$uid'";
        $resultCompletedAdmin = mysqli_query($con, $countCompletedQueryAdmin);
        $rowCompletedAdmin = mysqli_fetch_assoc($resultCompletedAdmin);
        $totalCompletedAdmin = $rowCompletedAdmin['total_completed_Admin'];

        // Query to count total tasks pending
        $countPendingQueryAdmin = "SELECT COUNT(*) as total_pending_Admin FROM task WHERE final_project_status = 'Pending' AND admin_uid = '$uid'";
        $resultPendingAdmin = mysqli_query($con, $countPendingQueryAdmin);
        $rowPendingAdmin = mysqli_fetch_assoc($resultPendingAdmin);
        $totalPendingAdmin = $rowPendingAdmin['total_pending_Admin'];
        
    
    ?>
    <!-- Total Assign to You -->
    <div class="container taskAssToYou">
        <h1 class="title pb-4" ><span>Task Assign to you</span></h3>
        <div class="row gap-5">
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body pt-md-4">
                    <div class="row">
                        <div class="col-6"><center><h1><?php echo $totalAssigned; ?></h1></center></div>
                        <div class="col-6"><h5>Total Task Assigned to you</h5></div>
                    </div>
                    </div>
                </div>
            </div> 

            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body pt-md-4">
                    <div class="row">
                        <div class="col-6"><center><h1><?php echo $totalCompleted; ?></h1></center></div>
                        <div class="col-6"><h5>Total Task Completed</h5></div>
                    </div>
                    </div>
                </div>
            </div> 
            
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body pt-md-4">
                    <div class="row">
                        <div class="col-6"><center><h1><?php echo $totalPending; ?></h1></center></div>
                        <div class="col-6"><h5>Total Task Pending</h5></div>
                    </div>
                    </div>
                </div>
            </div>
        </div>   
    </div>

    <div class="container taskAssByYou">
        <h1 class="title pt-4 pb-4"><span>Task Assign By you</span></h3>
        <div class="row gap-5">

        <!-- Total Assign by You -->
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body pt-md-4">
                    <div class="row">
                        <div class="col-6"><center><h1><?php echo $totalAssignedAdmin; ?></h1></center></div>
                        <div class="col-6"><h5>Total Task Assigned by you</h5></div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body pt-md-4">
                    <div class="row">
                        <div class="col-6"><center><h1><?php echo $totalCompletedAdmin; ?></h1></center></div>
                        <div class="col-6"><h5>Total Task Completed</h5></div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body pt-md-4">
                    <div class="row">
                        <div class="col-6"><center><h1><?php echo $totalPendingAdmin;?></h1></center></div>
                        <div class="col-6"><h5>Total Task Pending</h5></div>
                    </div>
                    </div>
                </div>
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