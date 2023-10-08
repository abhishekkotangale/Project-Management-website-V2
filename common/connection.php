<?php

 $server = "localhost";
 $user = "root";
 $password = "";
 $db = "project_management";

    $con = mysqli_connect($server,$user,$password,$db);

    if($con){
        ?>
        
        
        
        <?php
    }else{
        ?>
        
    <script>
        alert("connection not Successful");
    </script>
    
    <?php
    }

?>
