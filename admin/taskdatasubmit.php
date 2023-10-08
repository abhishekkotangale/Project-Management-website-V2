<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location:../index.php');
}
include_once '../common/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uid = $_SESSION['uid'];
    $tid = isset($_POST['tid']) ? mysqli_real_escape_string($con, $_POST['tid']) : null;
    $remark = mysqli_real_escape_string($con, $_POST['remark']);
    $status = "Under Admin";
    $file_destination = NULL;
    $adminEmail = mysqli_real_escape_string($con, $_POST['adminEmail']);
    $projectName = mysqli_real_escape_string($con, $_POST['projectName']);

    $username = $_SESSION['username'];
    $to = $adminEmail;
    $subject = "$username Submitted the project task";
    $body = "Hi , \n\n The Project - $projectName  has been submitted by $username \n\n You can check submitted data on website \n\n Best Regards, \n Team Milestone";
                    
    if (isset($_FILES['task_file']) && $_FILES['task_file']['size'] > 0) {
        $allowedExtensions = array("jpeg", "jpg", "png", "docx", "doc", "pdf", "zip");
        $fileExtension = strtolower(pathinfo($_FILES['task_file']['name'], PATHINFO_EXTENSION));

        if (in_array($fileExtension, $allowedExtensions)) {
            $file_name = $_FILES['task_file']['name'];
            $file_tmp = $_FILES['task_file']['tmp_name'];
            $file_destination = "../user_task_sub_doc/" . $file_name;
            move_uploaded_file($file_tmp, $file_destination);
        } else {
            echo '<script>alert("Invalid file format. Allowed formats: jpeg, jpg, png, docx, doc, pdf, zip");</script>';
        }
    }

            $selectQuery = "SELECT admin_action, user_sub_status FROM task_submission WHERE tid = '$tid'";
            $result = mysqli_query($con, $selectQuery);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
            
                if ($row['admin_action'] == 'Rejected' && $row['user_sub_status'] == 'Rejected') {
                    $updatequery = "UPDATE task_submission SET user_task_file = " . ($file_destination ? "'$file_destination'" : "NULL") . " ,user_remark = '$remark', user_sub_status = '$status', admin_action = NULL, admin_remark = NULL  WHERE tid = '$tid'";
                    $query = mysqli_query($con, $updatequery);
            
                    if ($query) {
                        if (mail($to, $subject, $body)) {
                            echo '<script>';
                            echo 'var adminMail = "' . $adminEmail . '";';
                            echo 'alert("Email successfully sent to " + adminMail);';
                            echo '</script>';
                        } else {
                            echo "Email sending failed...";
                        }
                        header("Location: viewtask.php?tid=$tid");
                        exit();
                    } else {
                        header('Location: dashboard.php');
                        exit();
                    }
                }
            }
            $insertquery = "INSERT INTO task_submission (tid, user_task_file ,user_remark, user_sub_status) VALUES ('$tid'," . ($file_destination ? "'$file_destination'" : "NULL") . ",'$remark', '$status')";
            $query = mysqli_query($con, $insertquery);

            if ($query) {
                if (mail($to, $subject, $body)) {
                    echo '<script>';
                    echo 'var adminMail = "' . $adminEmail . '";';
                    echo 'alert("Email successfully sent to " + adminMail);';
                    echo '</script>';
                } else {
                    echo "Email sending failed...";
                }
                header("Location: viewtask.php?tid=" . $tid);
            } else {
                echo '<script>alert("An error occurred while updating the file.");</script>';
            }
} else {
    header('location:dashboard.php');
}
?>





