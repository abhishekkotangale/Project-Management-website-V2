

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Milestones</title>
    <link rel="icon" type="image/x-icon" href="assets/icon/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;500&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js@1.12.0"></script>
    <script src="../js/toast.js"></script>
    <link rel="stylesheet" href="../js/toast.css">
    <style>
        body{
            background-color: rgb(28, 30, 39);
        }

        .input{
            width: 100%;
             padding: 12px;
    box-sizing: border-box;
    background-color: rgb(28, 30, 39);
    border-radius: 12px;
    margin-bottom: 25px;
    border: 1px solid rgb(140, 151, 154);
    color: #3e3e40;
    font-size: 14px;
    outline: none;
    transform: all 0.5s ease;
  }

  .otpwidth{
    width: 40%;
    margin-top: 200px;
  }

  nav{
    background-color: rgb(19,17,28);
    height: 70px !important;
    padding-top: 20px !important;
}

.navbar-brand{
    font-weight: 600 !important;
    font-size: 25px !important;
    color: rgb(133, 76, 230)!important;
}

    </style>

</head>
<body>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#" >Milestones</a>
        </div>
      </nav>

    <center>
        <div class="container otpwidth">
            <h1 style="color:green"; class="pb-lg-5"></h1>
            <form action="otpverify.php" method="post">
                  <input type="text" placeholder="Enter OTP" class="input" name="otp"><br />
                <button  type="submit" name="submit" style="width: 100%; border-radius: 12px; background: rgb(55, 61, 63); height: 44px; border: none; color: rgb(140, 151, 154);">Verify OTP</button>
            </form>
        </div>
    </center>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>  