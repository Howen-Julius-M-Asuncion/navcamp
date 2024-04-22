<?php
    session_start();
    include_once('../config/config.php');
    include_once('../config/dbcon.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Detail - <?php echo SITE_NAME?></title>
    <link rel="icon" type="image/x-icon" href="<?php echo FAVICON;?>">
    <link href="./css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/71f85e3db5.js" crossorigin="anonymous"></script>
    <style>
    </style>
</head>
<body>
    <div class="container-fluid">
        <?php include_once('../components/user-sidebar.php');?>
            <div class="bg-light rounded p-3 shadow-sm m-4">
                <center>
                    <h3><b>Search for Rooms</b></h4>
                    <div class="search table-search">
                        <label>
                            <input id="searchInput" type="search" placeholder="Example: C45 Classroom">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </label>
                    </div>
                </center>
            </div>
        </div>
    </div>
</body>
<script></script>
</html>
<?php
    session_destroy();
?>