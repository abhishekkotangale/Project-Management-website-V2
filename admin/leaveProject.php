<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location:../index.php');
}
include '../common/connection.php';

if (isset($_GET['leaveProject']) || isset($_GET['actionTaker'])) {
    $id = $_GET['leaveProject'];
    $actionTaker = $_GET['actionTaker'];
    $mail_id = $_GET['mail_id'];
    $projectName = $_GET['projectName'];


    $id = mysqli_real_escape_string($con, $id);
    $actionTaker = mysqli_real_escape_string($con, $actionTaker);

    $userMailQuery = "SELECT * FROM users WHERE uid='$mail_id'";
    $UserMailshowData = mysqli_query($con, $userMailQuery);

    $userMailresult = mysqli_fetch_array($UserMailshowData);

    $updatequery = "UPDATE task SET user_freelancer_id = NULL WHERE tid = '$id'";
    $query = mysqli_query($con, $updatequery);

    $to = $userMailresult['email'];
   
    

    if ($query) {
        if ($actionTaker == 'user') {
            $subject = $_SESSION['username'] . ' left the project - ' . $projectName;
            $message = "Hii " . $userMailresult['username'] . ", \n" . $_SESSION['username'] . "  has left the project - " . $projectName . ".\n\nBest Regards,\nTeam Milestone";
            $retval = mail($to, $subject, $message);
            if ($retval == true) {
                header("Location: taskAssToYou.php");
            } else {
                header("Location: taskAssToYou.php");
            }
            
            exit();
        } else {
            $subject = $_SESSION['username'] . ' remove you from the project - ' . $projectName;
            $message = "Hii " . $userMailresult['username'] . ",\n " . $_SESSION['username'] . " has removed you from the project - " . $projectName . ".\n\nBest Regards,\nTeam Milestone";
            $retval = mail($to, $subject, $message);
            if ($retval == true) {
                header("Location: viewtask.php?tid=$id");
            } else {
                header("Location: viewtask.php?tid=$id");
            }
            
            exit();
        }
    } else {
        echo "Update failed: " . mysqli_error($con);
    }
} else {
    echo "Invalid parameters provided.";
}
?>
