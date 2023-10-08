<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Milestones</title>
    <link rel="icon" type="image/x-icon" href="assets/icon/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;500&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js@1.12.0"></script>
    <script src="js/toast.js"></script>
    <link rel="stylesheet" href="js/toast.css">
</head>
<body>

<?php 

    include 'common/connection.php';

    if(isset($_POST['submit'])){
        $username = mysqli_real_escape_string($con , $_POST['username']);
        $email = mysqli_real_escape_string($con , $_POST['email']);
        $password = mysqli_real_escape_string($con , $_POST['password']);

        $pass = password_hash($password, PASSWORD_BCRYPT);


        $emailquery = "select * from users where email='$email' ";
        $query = mysqli_query($con,$emailquery);

        $emailcount = mysqli_num_rows($query);

        if($emailcount > 0){
          ?>
            <script>
              emailExist();
            </script>
          <?php
        }else{
                $unique = rand(10000000,99999999);
                $insertquery = " insert into users (username , email , unique_id , password ) values('$username','$email','$unique','$pass') ";
                $iquery = mysqli_query($con,$insertquery);

                if($iquery){
                  $email_search = "select * from users where email = '$email'";
                  $query = mysqli_query($con , $email_search);
                  $email_count = mysqli_num_rows($query);
                  $email_pass = mysqli_fetch_assoc($query);
                  $_SESSION['uid'] = $email_pass['uid'];
                  $_SESSION['email'] = $email_pass['email'];
                  header("location:login_signup/sendotp.php");
                }else{
                    ?>
                    
                <script>
                    ErrorAccount();
                </script>
                
                <?php
                }
        }

    }

    ?>
   
    
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
          <a class="navbar-brand" href="#" >Milestones</a>
          <div class="">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link p-2" data-bs-toggle="modal" data-bs-target="#exampleModal"><i data-lucide="user-circle-2" class="signInLogo"></i> <span class="signInTitle">Sign In</span></a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 380px !important;">
          <div class="modal-content" style="background-color: rgb(28, 30, 39) !important;">
           
            <div class="ms-auto">
              <i data-lucide="x-circle" data-bs-dismiss="modal" aria-label="Close" style="color: white; cursor:pointer;"></i>
            </div>
            <div class="d-flex p-md-4 row">
              <div class="signup col-6">Sign Up</div>
              <div class="login col-6">Log In</div>
            </div>
            
            <div class="signup-form">
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
                <input type="text" placeholder="Choose a Username" class="input" name="username"><br />
                <input type="email" placeholder="Your Email Address" class="input" name="email"><br />
                <input type="password" placeholder="Choose a Password" class="input" name="password"><br />
                <button  type="submit" name="submit" style="width: 100%; border-radius: 12px; background: rgb(55, 61, 63); height: 44px;border: none; color: rgb(140, 151, 154);">Create Account</button>
                <!-- <div class="btn" type="submit" name="submit">Create account</div> -->
              </form>
            </div>
            
            <div class="login-form">
                <form action="login_signup/login.php" method="post">
                  <input type="text" placeholder="Email or Username" class="input" name="email"><br />
                  <input type="password" placeholder="Password" class="input" name="password"><br />
                  <button  type="submit" name="submit" style="width: 100%; border-radius: 12px; background: rgb(55, 61, 63); height: 44px; border: none; color: rgb(140, 151, 154);">Sign In</button>
                </form>
             </div>
            
          </div>
        </div>
            
            
          </div>
        </div>
      </div>

      <div class="container landingpage-info">
        <div class="row">
            <div class="col-lg-6 col-md-6">
              <h1 class="landing-page-heading">Power Your Projects <br> with Our App.</h1>
              <div class="pt-5 manage-project-button" data-bs-toggle="modal" data-bs-target="#exampleModal"><a class="text-white">Manage a New Project</a></div>
            </div>
            <div class="col-lg-6 col-md-6">
              <center>
              <div class="milestone-img">
                <img src="assets/icon/workflow.png" alt="" srcset="" class="milestone-image">
              </div>
              </center>
            </div>
          </div>
      </div>

      <div class="container features">
        <div class="title text-center">Key Features</div>
        <center>
            <div class="container">
                <div class="row p-4 features-container">
                    <div class="col-6 features-info">
                        <h1>Lorem Ipsum</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                    <div class="col-6 features-info">
                        <h1>Lorem Ipsum</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
                <div class="row p-4 features-container">
                    <div class="col-6 features-info">
                        <h1>Lorem Ipsum</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                    <div class="col-6 features-info">
                        <h1>Lorem Ipsum</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                
                </div>
            </div>
        </center>
      </div>

      <div class="container benefits">
        <div class="title-benefits text-center">Benefits</div>
        <center>
            <div class="container">
                <div class="row p-4 benefits-container">
                    <div class="col-6 benefits-info">
                        <h1>Lorem Ipsum</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                    <div class="col-6 benefits-info">
                        <h1>Lorem Ipsum</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
                <div class="row p-4 benefits-container">
                    <div class="col-6 benefits-info">
                        <h1>Lorem Ipsum</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                    <div class="col-6 benefits-info">
                        <h1>Lorem Ipsum</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                
                </div>
            </div>
        </center>
      </div>

      <footer>
        <center>
            <p>© 2023 <span style="color: rgb(133, 76, 230);">Milestones</span>. All rights reserved.</p>
        </center>
      </footer>


      <script src="https://unpkg.com/lucide@latest"></script>
      <script>
        lucide.createIcons();
      </script>    
      <script src="index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>  
