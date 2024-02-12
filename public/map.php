<?php
    session_start();
    include_once('../config/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maps - <?php echo SITE_NAME?></title>
    <link rel="icon" type="image/x-icon" href="<?php echo FAVICON;?>">
    <link href="./css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/71f85e3db5.js" crossorigin="anonymous"></script>
    <style>
        .container-fluid{
            --bs-gutter-x: 0;
        }
    </style>
</head>
<body>




    <div class="container-fluid">
    <?php include_once('../components/user-sidebar.php');?>
        <div id="map">

        </div>
        </div>
    </div>
</body>
<script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqiwP5iLMgwWgOAkKdTwAO3pl9bqZmb3E&loading=async&callback=initMap">
</script>
<script src="./js/maps.js"></script>
</html>
<?php
    session_destroy();
?>