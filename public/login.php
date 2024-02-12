<?php
    session_start();
    include_once('../config/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - <?php echo SITE_NAME?></title>
    <link rel="icon" type="image/x-icon" href="<?php echo FAVICON;?>">
    <link href="./css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/71f85e3db5.js" crossorigin="anonymous"></script>
    <style>
        .logo-landing {
            width: 15rem;
        }

        .title, .extra {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="">
            <div class="row">
                <div class="col title mt-5">
                    <img src="./images/logo.png" class="logo-landing">
                    <h1><strong>Holy Cross College<br>Campus Navigation</strong></h1>
                </div>
            </div>
            <!-- Login form -->
            <div class="row d-flex justify-content-center align-items-center mt-4">
                <div class="col-lg-4 col-md-5 col-sm-6 px-5">
                    <center><h3>Log In Your Account</h3></center>
                    <form method="post" action="/includes/auth.php" id="login-form">
                        <div class="input-field mt-3">
                            <div class="input-container">
                                <i class="in fa-solid fa-at"></i>
                                <input type="text" class="form-control" id="account-username" required="true" name="username" placeholder="ID or Username">
                            </div>
                        </div>
                        <div class="input-field mt-3">
                            <div class="input-container">
                                <i class="in fa-solid fa-key"></i>
                                <input type="password" class="form-control" id="account-password" required="true" name="password" placeholder="Password">
                            </div>
                        </div>
                        <!-- Login Error Message -->
                        <center><p class='error-field bg-danger bg-gradient bg-opacity-75 text-light text-center rounded-1 mt-2'>
                            <?php
                                if(isset($_SESSION['error_message'])){
                                    echo $_SESSION['error_message'];
                                }
                            ?>
                        </p></center>
                        <div class="input-field">
                            <button type="submit" class="btn btn-secondary w-100 rounded-4">Log In &nbsp;<i class="fa-solid fa-right-to-bracket"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col extra mt-5">
                    Continue without account? <a href="./index.php">Go Back</a>
                </div>
            </div>
        </div>
    </div>
</body>
<script>

</script>
</html>
<?php
    session_destroy();
?>