<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location:../index.php');
}
include ("../common/connection.php");

$outgoing_id = $_SESSION['unique_id'];
$tid = mysqli_real_escape_string($con, $_POST['tid']);
$message = mysqli_real_escape_string($con, $_POST['message']);


$sql = "INSERT INTO messages (tid, incoming_msg_id, outgoing_msg_id, msg)
        VALUES ('$tid', '$incoming_id', '$outgoing_id', '$message')";

$result = mysqli_query($con, $sql);


?>
