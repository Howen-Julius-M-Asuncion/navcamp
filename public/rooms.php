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
    <title>Search Rooms - <?php echo SITE_NAME?></title>
    <link rel="icon" type="image/x-icon" href="<?php echo FAVICON;?>">
    <link href="./css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/71f85e3db5.js" crossorigin="anonymous"></script>
    <style>
        .card {
            height:100%;
        }
        .gradient-mask {
            position: relative;
            overflow: hidden;
            height: 80px;
        }
        .gradient-mask::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 45px;
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0), rgba(255, 255, 255, 1));
        }
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
            <div class="bg-light rounded p-3 shadow-sm m-4">
                <div class="row px-3">
                    <div class="col d-flex justify-content-between my-2">
                        <h4><b>Currently Available</b></h4>
                        <div class="actions fs-6">
                            <button type="button" class="btn btn-light" id="viewAvailable"><i class="fa-solid fa-circle-chevron-right"></i>&nbsp;View More</button>
                        </div>
                    </div>
                </div>
                <div class="row px-3">
                    <?php 
                        $query = "SELECT * FROM rooms WHERE status='Available' LIMIT 4";
                        $result = $conn->query($query);
                        
                        if ($result->num_rows < 0) {
                            echo "No Entries Found!";
                        }else{
                            while($list=$result->fetch_assoc()){
                    ?>
                    <div class="col-3">
                        <div class="card card-classroom">
                            <img src="<?php echo BASE_URL?>/public/images/building_default.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?=$list['code']?></h5>
                                <div class="gradient-mask">
                                    <p class="card-text"><?=$list['description']?></p>
                                </div>
                                <a href="#" class="btn btn-outline-dark">More Details</a>
                            </div>
                        </div>
                    </div>
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>
            <div class="bg-light rounded p-3 shadow-sm m-4">
                <div class="row px-3">
                    <div class="col d-flex justify-content-between my-2">
                        <h4><b>Classrooms</b></h4>
                        <div class="actions fs-6">
                            <button type="button" class="btn btn-light" id="viewClassrooms"><i class="fa-solid fa-circle-chevron-right"></i>&nbsp;View More</button>
                        </div>
                    </div>
                </div>
                <div class="row px-3">
                    <?php 
                        $query = "SELECT * FROM rooms WHERE id IN (SELECT room_id FROM room_categories WHERE category_id = 1) AND status='Available'LIMIT 4";
                        $result2 = $conn->query($query);
                        
                        if ($result2->num_rows < 0) {
                            echo "No Entries Found!";
                        }else{
                            while($list=$result2->fetch_assoc()){
                    ?>
                    <div class="col-3">
                        <div class="card card-classroom">
                            <img src="<?php echo BASE_URL?>/public/images/building_default.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?=$list['code']?></h5>
                                <div class="gradient-mask">
                                    <p class="card-text"><?=$list['description']?></p>
                                </div>
                                <a href="#" class="btn btn-outline-dark">More Details</a>
                            </div>
                        </div>
                    </div>
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>
            <div class="bg-light rounded p-3 shadow-sm m-4">
                <div class="row px-3">
                    <div class="col d-flex justify-content-between my-2">
                        <h4><b>Laboratories</b></h4>
                        <div class="actions fs-6">
                            <button type="button" class="btn btn-light" id="viewLabs"><i class="fa-solid fa-circle-chevron-right"></i>&nbsp;View More</button>
                        </div>
                    </div>
                </div>
                <div class="row px-3">
                    <?php 
                        $query = "SELECT * FROM rooms WHERE id IN (SELECT room_id FROM room_categories WHERE category_id = 3) AND status='Available'LIMIT 4";
                        $result2 = $conn->query($query);
                        
                        if ($result2->num_rows < 0) {
                            echo "No Entries Found!";
                        }else{
                            while($list=$result2->fetch_assoc()){
                    ?>
                    <div class="col-3">
                        <div class="card card-classroom">
                            <img src="<?php echo BASE_URL?>/public/images/building_default.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?=$list['code']?></h5>
                                <div class="gradient-mask">
                                    <p class="card-text"><?=$list['description']?></p>
                                </div>
                                <a href="#" class="btn btn-outline-dark">More Details</a>
                            </div>
                        </div>
                    </div>
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>
            <div class="bg-light rounded p-3 shadow-sm m-4">
                <div class="row px-3">
                    <div class="col d-flex justify-content-between my-2">
                        <h4><b>Venues</b></h4>
                        <div class="actions fs-6">
                            <button type="button" class="btn btn-light" id="viewVenues"><i class="fa-solid fa-circle-chevron-right"></i>&nbsp;View More</button>
                        </div>
                    </div>
                </div>
                <div class="row px-3">
                    <?php 
                        $query = "SELECT * FROM rooms WHERE id IN (SELECT room_id FROM room_categories WHERE category_id = 2) AND status='Available'LIMIT 4";
                        $result2 = $conn->query($query);
                        
                        if ($result2->num_rows < 0) {
                            echo "No Entries Found!";
                        }else{
                            while($list=$result2->fetch_assoc()){
                    ?>
                    <div class="col-3">
                        <div class="card card-classroom">
                            <img src="<?php echo BASE_URL?>/public/images/building_default.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?=$list['code']?></h5>
                                <div class="gradient-mask">
                                    <p class="card-text"><?=$list['description']?></p>
                                </div>
                                <a href="#" class="btn btn-outline-dark">More Details</a>
                            </div>
                        </div>
                    </div>
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
<script></script>
</html>
<?php
    session_destroy();
?>