<?php
    if(!isset($_SESSION['username'])){
        header('location:../index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="chat.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
</head>
<body>
<div class="wrapper">
    <section class="chat-area">
        <header>
            <?php 
                if($_SESSION['uid']==$row['admin_uid']){
                    $incoming_id_user = $row['user_freelancer_id'];
                }else if($_SESSION['uid']==$row['user_freelancer_id']){
                    $incoming_id_user = $row['admin_uid'];
                }

                $showquery = "select * from users where uid='$incoming_id_user' ";
                $showData = mysqli_query($con,$showquery);

                $result = mysqli_fetch_array($showData);
            ?>
        </header>
        <center><h3>Chat</h3></center>
        <div class="chat-box"></div>
        <script>var tid = <?php echo $id; ?>;</script>
        <form action="msg.php" method="post" class="typing-area">
            <input type="text" class="incoming_id" name="tid" value="<?php echo $id ?>" hidden>
            <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $result['unique_id']; ?>" hidden>
            <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
            <button type="submit" name="submit"><i class="fab fa-telegram-plane"></i></button>
        </form>
    </section>
</div>
</body>
</html>