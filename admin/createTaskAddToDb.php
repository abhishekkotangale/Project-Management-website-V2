<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:../index.php');
    }

    include '../common/connection.php';

    $uid = $_SESSION['uid'];

    $title = mysqli_real_escape_string($con, $_POST['title']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $deadline = $_POST['date'];
    $num = rand(10000000, 99999999);


    if (isset($_FILES['task_file']) && $_FILES['task_file']['size'] > 0) {
        $allowedExtensions = array("zip", "pdf", "jpg", "jpeg", "png");
        $fileExtension = strtolower(pathinfo($_FILES['task_file']['name'], PATHINFO_EXTENSION));

        if (in_array($fileExtension, $allowedExtensions)) {
            $file_name = $_FILES['task_file']['name'];
            $file_tmp = $_FILES['task_file']['tmp_name'];
            $file_destination = "../task_doc/" . $file_name;
            move_uploaded_file($file_tmp, $file_destination);


            $insertquery = "INSERT INTO task (admin_uid, task_name, task_details , task_doc, deadline ,task_room_code) VALUES ('$uid', '$title', '$description','$file_destination','$deadline' , '$num')";

            $query = mysqli_query($con, $insertquery);

            if ($query) {
                header("Location: viewtask.php?tid=" . mysqli_insert_id($con));
            } else {
                header('location:dashboard.php');
            }
        } else {
            echo '<script>alert("Invalid file format. Allowed formats: zip, pdf, jpg, jpeg, png");</script>';
        }
    } else {
        // Handle the case when no file is uploaded here
        $insertquery = "INSERT INTO task (admin_uid, task_name, task_details, deadline, task_room_code) VALUES ('$uid', '$title', '$description', '$deadline', '$num')";
        $query = mysqli_query($con, $insertquery);

        if ($query) {
            header("Location: viewtask.php?tid=" . mysqli_insert_id($con));
        } else {
            header('location:dashboard.php');
        }
    }
?>
