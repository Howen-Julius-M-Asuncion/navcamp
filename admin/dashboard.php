<?php
    include_once('../config/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - <?php echo SITE_NAME?></title>
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
        <?php include_once('../components/admin-sidebar.php');?>
            <div class="row statistics mx-4 mt-4">
                <div class="col bg-light rounded-3 p-3 shadow-sm mb-5 me-2">
                    <?php
                        echo '--- Registered Users';
                    ?>
                </div>
                <div class="col bg-light rounded-3 p-3 shadow-sm mb-5 ms-2">
                    <?php
                        echo '--- Online Users';
                    ?>
                </div>
            </div>    
        
        </div>
    </div>
</body>

<script src="./js/script.js"></script>
<script>
    /* Script Here */
</script>

</html>