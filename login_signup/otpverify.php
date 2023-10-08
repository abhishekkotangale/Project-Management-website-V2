<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:../index.php');
    }

    include('../common/connection.php');
    $uid = $_SESSION['uid'];
    $otp = $_POST['otp'];
    $showquery = "select * from users where uid='$uid' ";
    $showData = mysqli_query($con,$showquery);
     
    $result = mysqli_fetch_array($showData);
    echo $result['otp'];
    if($otp === $result['otp']){

        
        $newupdatequery = "update users set status='Active' where uid='$uid'";
        $nquery = mysqli_query($con,$newupdatequery);
        if($nquery){
            header('location:../admin/dashboard.php');
        }else{
            echo "not inserted";
        }
    }else{
        echo "does not match";
    }
?>