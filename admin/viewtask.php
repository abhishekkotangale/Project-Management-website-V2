<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:../index.php');
    }
?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Project Details</title>
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
                $id = mysqli_real_escape_string($con, $_GET["tid"]);
                if (isset($_GET["tid"])) {
                    $id = mysqli_real_escape_string($con, $_GET["tid"]);

                    $uid = $_SESSION['uid'];

                    $sql = "SELECT * FROM task LEFT JOIN task_submission ON task.tid = task_submission.tid WHERE task.tid = $id";
                    $result = mysqli_query($con, $sql);

                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);

                            ?>
                             
                             <div class="row">
                                <div class="col-lg-8 col-md-12">
                                <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                    
                                    <?php
                                        if($row['admin_uid'] == $_SESSION['uid']){
                                            echo '<p class="text-info" style="float:left;">task room code - ' . $row['task_room_code'] . '</p>';
                                        }
                                        if ($row['user_freelancer_id'] == $_SESSION['uid'] ) {
                                            ?>  
                                                <button style="float:right;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#leaveProjectUser">
                                                    Leave Project
                                                </button>
                                                <div class="modal fade" id="leaveProjectUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Confirm Leave Project</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to Leave this Project? 
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <a type="button" class="btn btn-primary text-white" href="leaveProject.php?leaveProject=<?php echo $id; ?>&actionTaker=user&mail_id=<?php echo $row['admin_uid']; ?>&projectName=<?php echo $row['task_name']; ?>">Leave Project</a>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                        }else if (($row['admin_uid'] == $_SESSION['uid']) && ($row['user_freelancer_id'] !=NULL)) {
                                            ?>
                                                <button style="float:right;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#removeUserModal">
                                                    Remove user
                                                </button>
                                                <div class="modal fade" id="removeUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Confirm User Removal</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to remove this user? 
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <a type="button" class="btn btn-primary text-white" href="leaveProject.php?leaveProject=<?php echo $id; ?>&mail_id=<?php echo $row['user_freelancer_id']; ?>&projectName=<?php echo $row['task_name']; ?>">Remove user</a>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                        }
                                    ?>
                                    </div>
                                    <div class="col-12 mb-4">
                                        <?php 
                                        if($row['user_freelancer_id'] == $uid){
                                            $sql = "SELECT * FROM users WHERE uid = {$row['admin_uid']}";
                                            $adminresult = mysqli_query($con, $sql);
                    
                                            if (!$adminresult) {
                                                echo "User retrieval failed: " . mysqli_error($con);
                                            } else {
                                                $adminrow = mysqli_fetch_assoc($adminresult);
                    
                                                if ($adminrow) {
                                                    ?>
                                                    <h5 style="margin-top:-30px;">Project Assigner:  <span class="p-4"><img src="<?php echo $adminrow['profile'] ?>" width="30px"alt="" srcset=""></spane><span class="text-success p-3"><?php echo $adminrow['username'] ?></span></h5>
                                                    <?php
                                                } else {
                                                    echo "User not found";
                                                }
                                            }
                                            }
                                        ?>
                                        
                                    </div>
                                </div>
                                <h3>Project Name:  <?php echo $row['task_name']; ?></h3>
                                <h5 class="mt-4 mb-4">Project Description :</h5>
                                <div class="container">
                                    <div class="container">
                                        <div>
                                            <p class="pb-lg-4">
                                                <?php echo nl2br($row['task_details']); ?>
                                            </p>
                                        </div>
                                        <div>
                                        <?php
                                            $file_path = isset($row['task_doc']) ? $row['task_doc'] : "";
                                            $file_extension = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
                                            if (in_array($file_extension, array("jpg", "jpeg", "png"))) {
                                                echo '<a  href="' . $file_path . '" download>Download Project Document</a>';
                                            } elseif (in_array($file_extension, array("doc", "zip", "pdf"))) {
                                                echo '<a  href="' . $file_path . '" download>Download Project Document</a>';
                                            }
                                        ?>
                                        </div>
                                    </div>
                                </div>
                                <?php


                                    if ($row['admin_uid'] == $uid) {
                                        if ($row['user_freelancer_id']==NULL) {
                                            ?>
                                                <div class="d-flex mt-3">
                                                    <div class="  m-4 text-danger"><p><b>No user joined</b></p></div>
                                                    <div class=" m-4"><p><a class="btn btn-primary" href="adduser.php?task_room_code=<?php echo $row['task_room_code']; ?>&&tid=<?php echo $id;?>">Add user</a></p></div>
                                                </div>
                                            <?php
                                        }else if($row['user_freelancer_id']!=NULL){
                                            $sql = "SELECT * FROM users WHERE uid = {$row['user_freelancer_id']}";
                                            $userresult = mysqli_query($con, $sql);
                    
                                            if (!$userresult) {
                                                echo "User retrieval failed: " . mysqli_error($con);
                                            } else {
                                                $userrow = mysqli_fetch_assoc($userresult);
                    
                                                if ($userrow) {
                                                    ?>
                                                    <div class="mt-5 m-4">
                                                            <h5>Project Executor:  <span class="p-4"><img src="<?php echo $userrow['profile'] ?>" width="40px"alt="" srcset=""></spane><span class="text-success p-3"><?php echo $userrow['username'] ?></span></h5>
                                                    </div>
                                                      
                                                    <?php
                                                } else {
                                                    echo "User not found";
                                                }
                                            }
                                        }
                                        ?>
                                        
                                        <div class="d-flex">
                                            <div class="ml-3 mr-3"><a type="button" class="btn btn-primary text-white" href="updateProject.php?updateProject=<?php echo $id; ?>">Update Project</a></div>
                                            <div class="">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#deleteProjectModal">
                                                    Delete Project
                                            </button>
                                                <div class="modal fade" id="deleteProjectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Confirm Delete Project</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to Delete this Project? 
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <a type="button" class="btn btn-primary text-white" href="deleteProject.php?deleteProject=<?php echo $id; ?>">Delete Project</a>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    
                                ?>
                                <!-- User Section -->
                            <?php
                            if($row['user_sub_status'] == "Accepted" and $uid == $row['user_freelancer_id']){
                                ?>
                                    <div class="container mt-4">
                                        <h1 class="text-success">Status - Accepted</h1>
                                        <h5 class="mb-3">Congratulations, your Work Accepted and project completed</h5>
                                        <p><b>Admin Remark : </b><?php echo nl2br($row['admin_remark']); ?></p>
                                    </div>
                                <?php
                            }else if($row['user_sub_status'] == "Under Admin" and $uid == $row['user_freelancer_id']){
                                ?>
                                    <div class="mt-4 mb-3">
                                        <h4 class="mb-4">Status:<span class="text-success">Under Admin<span></h4>
                                        <h5>Your Subsmission Data:-</h5>
                                    </div>   
                                    <div class="container">
                                    <?php
                                    if ($row['user_task_file']!=NUll) {
                                        echo '<a  href="' . $file_path . '" download>Download Project Document Submitted by you</a>';
                                    }      
                                    ?>
                                    <div class="mt-3"> <p><b>Your Remark: </b><?php echo nl2br($row['user_remark']); ?></p></div>
                                    <center><a class="btn btn-primary mb-4" href="userUpdateSub.php?userUpdateSub=<?php echo urlencode($id); ?>&adminmail=<?php echo $adminrow['email']; ?>&projectName=<?php echo $row['task_name']; ?>">Update Submission</a></center>
                                    </div>
                                <?php
                            }else if ($uid == $row['user_freelancer_id'] or ($row['user_sub_status'] == "Rejected" and $uid == $row['user_freelancer_id'])) {
                                if($row['user_sub_status'] == "Rejected" or $row['admin_action'] == "Rejected"){
                                    ?>
                                        <div class="container m-4">
                                            <h4 class="text-danger">Status : Rejected </h4> 
                                            <p class="mt-3"><b>Admin Remark :- </b><?php echo nl2br($row['admin_remark']);?></p>
                                        </div>
                                    <?php
    
                                }
                                ?>
                                    <div class="container mt-5">
                                        <center><h2>Submit Task</h2></center>
                                        <form class="container" action="taskdatasubmit.php" method="post" enctype="multipart/form-data">
                                            <div class="mb-3">
                                                <label for="formFileMultiple" class="form-label">Upload Files:</label></br>
                                                <label for="formFileMultiple" class="form-label text-danger">If there are multiple file in project Please make Zip folder And Upload*</label>
                                                <input class="form-control" type="file" name="task_file" id="formFileMultiple" multiple>
                                            </div>
                                            <div class="mb-3">
                                                <input type="email" class="form-control" name="adminEmail" value="<?php echo $adminrow['email']; ?>" hidden>
                                            </div>
                                            <div class="mb-3">
                                                <input type="text" class="form-control" name="projectName" value="<?php echo $row['task_name']; ?>" hidden>
                                            </div>
                                            <div class="mb-3">
                                                <input type="text" class="form-control" Placeholder="Enter Your Remark(Message to project Manager)" name="remark" required>
                                            </div>
                                            <input type="hidden" name="tid" value="<?php echo $id; ?>">
                                            <center><button type="submit" class="btn btn-primary mb-4 " name="submit">Submit</button></center>
                                        </form>
                                    </div>
                                <?php
                            }
                            # Admin Update Section

                            if ($row['admin_remark'] != NULL and $row['admin_uid'] == $uid) {
                                ?>
                                <div class="container mt-4">
                                    <p><b>Your Remark :- </b> <?php echo nl2br($row['admin_remark']); ?></p>
                                </div>
                                <center><a class="btn btn-primary" href="adminRemarkUp.php?adminRemarkUp=<?php echo urlencode($id); ?>">Update Remark</a></center>
                                <?php
                            }
                            if(($row['user_sub_status'] == "pending" && $uid == $row['admin_uid']) || ($row['user_sub_status'] == NULL && $uid == $row['admin_uid']) || ($row['admin_action'] == 'Rejected' && $uid == $row['admin_uid'])){
                                ?>
                                    <div class="container mt-4">
                                        <h4>Status : <span class="text-warning">Pending</span></h4>
                                    </div>
                                <?php
                            }else if($row['user_sub_status'] == "Under Admin" and $uid == $row['admin_uid']){
                                ?>
                                    <div class="container mt-5">
                                        <h4>Task Submitted By user : </h4>
                                        <div class="container">
                                            <?php 
                                            
                                                if ($row['user_task_file']!=NUll) {
                                                    echo '<a  href="' . $file_path . '" download>Download Project Document Submitted by user</a>';
                                                }
                                            ?>
                                            <div class="mt-3"> <p><b>User Remark: </b><?php echo nl2br($row['user_remark']); ?></p></div>
                                        </div>
                                        

                                        <center><h4>Accept or reject task</h4></center>
                                        <form class="container" action="acceptrejecttask.php" method="post"> 
                                                <label>Remark<sup class="text-danger">*</sup></label>
                                                <div class="form-floating mb-3">
                                                    <textarea class="form-control" id="floatingTextarea" name="admin_remark" cols="30" rows="10" required></textarea>
                                                </div>
                                                <input type="hidden" name="task_id" value="<?php echo $row['tid']; ?>">
                                                <input type="hidden" name="user_mail" value="<?php echo $userrow['email']; ?>">
                                                <input type="hidden" name="projectName" value="<?php echo $row['task_name']; ?>">

                                                <center><button type="submit" name="action"  class="btn btn-primary mb-4 " value="accept">Accept</button>
                                            <button type="submit" name="action"  class="btn btn-primary mb-4 " value="reject">Reject</button></center>
                                        </form>
                                    </div>
                                <?php

                                $sql = "SELECT * FROM task_submission  WHERE tid = $id";
                                $result = mysqli_query($con, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                                }
                            }else if($row['user_sub_status'] == "Accepted"  and $row['admin_action'] == "Accepted"and $uid == $row['admin_uid']){
                                ?>
                                    <div class="m-4">
                                        <h1 class="text-success">Status :- Completed</h1>
                                    </div>
                                <?php
                            }

                            ?>                                                

</div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <?php include('chat.php'); ?>
                                </div>
                            </div>

                            <?php
                        } else {
                            echo "No task found with the specified ID.";
                        }
                    } else {
                        echo "Error executing the database query.";
                    }
                } else {
                    echo "Task ID (tid) is not set in the URL parameters.";
                }
                ?>


                
        </div>
	</div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- JavaScript code for fetching and displaying messages -->
    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="chat.js"></script>


    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>