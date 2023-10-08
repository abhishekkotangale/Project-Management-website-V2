<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location:../index.php');
}
include_once "../common/connection.php";


$id = isset($_GET['tid']) ? mysqli_real_escape_string($con, $_GET['tid']) : null;
$outgoing_id = $_SESSION['unique_id'];

if ($id === null || !is_numeric($id)) {
    die('Invalid Task ID');
}

$sql = "SELECT * FROM messages WHERE tid = $id ORDER BY msg_id";
$query = mysqli_query($con, $sql);

$output = "";

if ($query) {
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            if ($row['outgoing_msg_id'] === $outgoing_id) {
                $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>' . $row['msg'] . '</p>
                                </div>
                            </div>';
            } else {
                $output .= '<div class="chat incoming">
                                <div class="details">
                                    <p>' . $row['msg'] . '</p>
                                </div>
                            </div>';
            }
        }
    } else {
        $output .= '<div class="text">No messages are available. Once you send a message, they will appear here.</div>';
    }
} else {
    $output .= '<div class="text">Error fetching messages: ' . mysqli_error($con) . '</div>';
}

echo $output;
?>
<script src="chat.js"></script>