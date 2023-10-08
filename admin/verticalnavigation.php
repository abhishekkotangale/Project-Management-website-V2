<?php 
    include('../common/connection.php');
    
    $id = $_SESSION['uid'];
    $sql = "SELECT * FROM users WHERE uid = $id";
    $userProfileVerNav = mysqli_query($con, $sql);
     if (!$userProfileVerNav) {
         echo "User retrieval failed: " . mysqli_error($con);
     } else {
         $userProfileVerNavRow = mysqli_fetch_assoc($userProfileVerNav);
     }

  
?>


		<nav id="sidebar">
			<div class="p-4 pt-5">
		  		<a href="#" class="img logo rounded-circle mb-5" style="background-image: url(<?php echo $userProfileVerNavRow['profile']; ?>);"></a>

	        <ul class="list-unstyled components mb-5" >
	          <li>
	              <a href="dashboard.php"  class="nav-link">Dashboard</a>
	          </li>
	          <li>
                <a href="createTask.php" class="nav-link">Create Task</a>
	          </li>
	          <li>
                <a href="joinTask.php" class="nav-link">Join Project</a>
	          </li>
              <li>
	              <a href="taskAssToYou.php" class="nav-link">Task Assign to you</a>
	          </li>
	          <li>
                <a href="taskAssByYou.php" class="nav-link">Task Assign by you</a>
	          </li>
	          <li>
                <a href="support.php" class="nav-link">Support</a>
	          </li>
	        </ul>
	      </div>
    </nav>

	