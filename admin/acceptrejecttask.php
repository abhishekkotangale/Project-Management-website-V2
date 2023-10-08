<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location:../index.php');
}
include '../common/connection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $task_id = $_POST['task_id'];
        $admin_remark = $_POST['admin_remark'];
        $action = $_POST['action'];

        $user_mail = $_POST['user_mail'];
        $projectName = $_POST['projectName'];
        $username = $_SESSION['username'];

        $showquery = "select * from task_submission where tid='$tid' ";
        $showData = mysqli_query($con,$showquery);

        $result = mysqli_fetch_array($showData);

        if ($action === 'accept') {
            $finalupdatequery = "UPDATE task SET final_project_status='Completed' WHERE tid='$task_id'";
            $query = mysqli_query($con, $finalupdatequery);

            $updatequery = "update task_submission set admin_action='Accepted' , user_sub_status='Accepted' ,admin_remark = '$admin_remark' where tid='$task_id'";
            $query = mysqli_query($con,$updatequery);

            $subject = "$username Accepted the project task submitted by you";
            $body = "Hi , \n\n Congratulations , The Project - $projectName  submission has been accepted by $username \n\n You can check remark given by project manager on website \n\n Best Regards, \n Team Milestone";

            if($query){
                    if (mail($user_mail, $subject, $body)) {
                        echo '<script>';
                        echo 'var user_mail = "' . $user_mail . '";';
                        echo 'alert("Email successfully sent to " + user_mail);';
                        echo '</script>';
                    } else {
                        echo "Email sending failed...";
                    }
                header("Location: viewtask.php?tid=" . $task_id);
            }else{
                echo "not inserted";
            }
        } else if ($action === 'reject') {
            $updatequery = "update task_submission set admin_action='Rejected' , user_sub_status='Rejected' ,admin_remark = '$admin_remark' where tid='$task_id'";
            $query = mysqli_query($con,$updatequery);

            $subject = "$username Rejected the project task submitted by you";
            $body = "Hi , \n\n Unfortunately , The Project - $projectName  submission has been rejected by $username \n\n You can check remark given by project manager on website \n\n Best Regards, \n Team Milestone";

            if($query){
                if (mail($user_mail, $subject, $body)) {
                    echo '<script>';
                    echo 'var user_mail = "' . $user_mail . '";';
                    echo 'alert("Email successfully sent to " + user_mail);';
                    echo '</script>';
                } else {
                    echo "Email sending failed...";
                }
                header("Location: viewtask.php?tid=" . $task_id);
            }else{
                echo "not inserted";
            }
        } 
    } 
}
?>
