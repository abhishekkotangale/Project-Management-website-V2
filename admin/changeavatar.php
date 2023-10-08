<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:../index.php');
    }

    include '../common/connection.php';

    $uid = $_SESSION['uid'];

    $avatar =  $_FILES['avatar'];
    
    $filename = $avatar['name'];
    $filepath = $avatar['tmp_name'];
    $fileerror = $avatar['error'];

    if($fileerror == 0){
        $destfile = 'user_images/'.$filename;

        move_uploaded_file($filepath,$destfile);

        $updatequery = "update users set profile  = '$destfile' where uid='$uid'";
    
            $query = mysqli_query($con,$updatequery);
    
            if($query){
                ?>
                    <script>location.replace('setting.php')</script>
                <?php
            }else{
                echo "not inserted";
            }

    }
?>