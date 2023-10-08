<?php 
    include('../common/connection.php');
    
    $id = $_SESSION['uid'];
    $sql = "SELECT * FROM users WHERE uid = $id";
    $userProfileResult = mysqli_query($con, $sql);
     if (!$userProfileResult) {
         echo "User retrieval failed: " . mysqli_error($con);
     } else {
         $userProfileRow = mysqli_fetch_assoc($userProfileResult);
     }
  
?>
  
    <!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .company_name{
            font-weight: 600 !important;
            font-size: 25px !important;
            color: rgb(133, 76, 230)!important;
        }
    </style>
  </head>
  <body>
    
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button type="button" id="sidebarCollapse" class="btn btn-primary">
            <i class="fa fa-bars"></i>
            <span class="sr-only">Toggle Menu</span>
        </button>
        
        <div class="navbar-brand mx-auto">
            <center><span class="company_name">Milestone</span></center>
        </div>
        
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle pr-3" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo $userProfileRow['profile'];?>" width="50px" alt="" srcset="" style="border-radius: 50px;">
                </a>
                
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="setting.php">Setting</a></li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

 

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    
  </body>
</html>