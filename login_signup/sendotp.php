<?php 
session_start();
if(!isset($_SESSION['username'])){
    header('location:../index.php');
}

include('../common/connection.php');

echo $_SESSION['email'];
$uid = $_SESSION['uid'];
echo $uid;
$num =  rand(100000,999999);

$to = $_SESSION['email'];
$username = $_SESSION['username'];
$subject = "OTP for Account Verification";
$message = "Hii $username,\n\n Welcome to Milestone \n here is your OTP - $num \n\n Best Regards, \n Team Milestone";

$retval = mail ($to,$subject,$message);
     
     if( $retval == true ) {
        ?>
            <script>
                otp();
            </script>
        <?php
     }else {
        ?>
            <script>
                otpNotSent();
            </script>
        <?php
     }

     $showquery = "select * from users where uid='$uid' ";
     $showData = mysqli_query($con,$showquery);
 
     $result = mysqli_fetch_array($showData);
 
         $updatequery = "update users set otp='$num' where uid='$uid'";
 
         $query = mysqli_query($con,$updatequery);
 
         if($query){
            header('location:otp.php');
         }else{
             echo "not inserted";
         }
?>