<?php
    include_once('../config/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME?></title>
    <link rel="icon" type="image/x-icon" href="<?php echo FAVICON;?>">
    <link href="./css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/71f85e3db5.js" crossorigin="anonymous"></script>
    <style>
        .logo-landing {
            width: 10rem;
        }

        .title, .extra {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container py-3">
        <div class="">
            <div class="row">
                <div class="col title">
                    <img src="./images/logo.png" class="logo-landing">
                    <h1><strong>Holy Cross College<br>Campus Navigation</strong></h1>
                    <h4 class="mt-3">Select Campus Experience</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md- d-flex justify-content-center align-items-center mt-1">
                    <div class="card m-2 pt-3 bg-secondary bg-gradient text-light" style="">
                        <div class="card-img-top p-2" id="guestCard">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M224 256c-57.2 0-105.6-37.5-122-89.3c-1.1 1.3-2.2 2.6-3.5 3.8c-15.8 15.8-38.8 20.7-53.6 22.1c-8.1 .8-14.6-5.7-13.8-13.8c1.4-14.7 6.3-37.8 22.1-53.6c5.8-5.8 12.6-10.1 19.6-13.4c-7-3.2-13.8-7.6-19.6-13.4C37.4 82.7 32.6 59.7 31.1 44.9c-.8-8.1 5.7-14.6 13.8-13.8c14.7 1.4 37.8 6.3 53.6 22.1c4.8 4.8 8.7 10.4 11.7 16.1C131.4 28.2 174.4 0 224 0c70.7 0 128 57.3 128 128s-57.3 128-128 128zM0 482.3C0 399.5 56.4 330 132.8 309.9c6-1.6 12.2 .9 15.9 5.8l62.5 83.3c6.4 8.5 19.2 8.5 25.6 0l62.5-83.3c3.7-4.9 9.9-7.4 15.9-5.8C391.6 330 448 399.5 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM160 96c-8.8 0-16 7.2-16 16s7.2 16 16 16H288c8.8 0 16-7.2 16-16s-7.2-16-16-16H160z"/></svg>
                        </div>   
                        <div class="card-body">
                            <h4 class="card-title">Guest</h4>
                            <p class="card-text">Continue as a guest.</p>
                        </div>
                    </div>
                    <!-- <div class="card m-2 pt-3 bg-secondary bg-gradient text-light" style="">
                        <div class="card-img-top pt-2" id="studentCard">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.<path d="M219.3 .5c3.1-.6 6.3-.6 9.4 0l200 40C439.9 42.7 448 52.6 448 64s-8.1 21.3-19.3 23.5L352 102.9V160c0 70.7-57.3 128-128 128s-128-57.3-128-128V102.9L48 93.3v65.1l15.7 78.4c.9 4.7-.3 9.6-3.3 13.3s-7.6 5.9-12.4 5.9H16c-4.8 0-9.3-2.1-12.4-5.9s-4.3-8.6-3.3-13.3L16 158.4V86.6C6.5 83.3 0 74.3 0 64C0 52.6 8.1 42.7 19.3 40.5l200-40zM111.9 327.7c10.5-3.4 21.8 .4 29.4 8.5l71 75.5c6.3 6.7 17 6.7 23.3 0l71-75.5c7.6-8.1 18.9-11.9 29.4-8.5C401 348.6 448 409.4 448 481.3c0 17-13.8 30.7-30.7 30.7H30.7C13.8 512 0 498.2 0 481.3c0-71.9 47-132.7 111.9-153.6z"/></svg>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Member</h4>
                            <p class="card-text">Continue as a member.</p>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="row">
                <div class="col extra mt-3">
                    Continue with account? <a href="./login.php">Login Here!</a>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    // JavaScript function to handle card click and nvagiation to map.php
    function redirectToTargetPage(userType) {
        var targetPage = './map.php';
        window.location.href = targetPage + '?userType=' + userType;
    }

    // Add click event listeners to the cards
    document.getElementById('guestCard').addEventListener('click', function() {
        redirectToTargetPage('guest');
    });

    document.getElementById('studentCard').addEventListener('click', function() {
        redirectToTargetPage('member');
    });
</script>

</html>