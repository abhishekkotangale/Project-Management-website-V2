<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];
    $newMsg = "Email address :- $email \n $message";
    $to = "testcase682@gmail.com";
    $subject = "Contact Form Submission from $name";
    
  
    if (mail($to, $subject, $newMsg, $headers)) {
        ?>
            <script>
                alert('Mail send successfully');
                location.replace('support.php');
            </script>
        <?php
    } else {
        ?>
            <script>
                alert('Email Delivery Failed');
                location.replace('support.php');
            </script>
        <?php
    }
} else {
    echo "Invalid request.";
}
?>
