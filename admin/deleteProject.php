<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:../index.php');
    }
    include '../common/connection.php';

    $tid = $_GET['deleteProject'];

    $deleteQuery = "delete from task where tid='$tid' ";
    
    $query = mysqli_query($con,$deleteQuery);

    if($query){
        ?>
            <script>
                alert("Deleted Successfully");
            </script>
        <?php
            header('location:taskAssByYou.php');
    }else{
        ?>
            <script>
                alert("Please Try again after Some time");
            </script>
        <?php
    }
?>