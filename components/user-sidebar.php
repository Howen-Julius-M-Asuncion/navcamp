<?php include_once('../config/config.php');?>
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/71f85e3db5.js" crossorigin="anonymous"></script> -->
<link rel="stylesheet" href="<?php echo BASE_URL?>/components/css/sidebar.css">

<!-- Sidebar -->
<div class="navigation">
    <ul>
        <li>
            <a href="#">
                <span class="icon"><img src="<?php echo FAVICON;?>"></span>
                <span class="title"><?php echo SITE_NAME?></span>
            </a>
        </li>
        <hr>
        <li>
            <a href="">
                <span class="icon">
                    <i class="fa-solid fa-people-roof"></i>
                </span>
                <span class="title">Rooms</span>
            </a>
        </li>
        <li>
            <a href="">
                <span class="icon">
                    <i class="fa-regular fa-calendar-days"></i>
                </span>
                <span class="title">Schedules</span>
            </a>
        </li>
        <hr>
        <li>
            <a href="<?php echo BASE_URL?>/public/map.php">
                <span class="icon">
                    <i class="fa-solid fa-map"></i>
                </span>
                <span class="title">Maps</span>
            </a>
        </li>
        <li>
            <a href="">
                <span class="icon">
                    <i class="fa-solid fa-person-walking-arrow-right"></i>
                </span>
                <span class="title">Exit</span>
            </a>
        </li>
    </ul>
</div>

<!-- Main Section -->
<div class="main">

    <!-- Sidebar -->
    <div class="topbar">
        <div class="toggle">
            <i class="icon-bars fa-solid fa-bars"></i>
        </div>
    </div>

    <!-- Sidebar Script -->
    <script src="<?php echo BASE_URL?>/components/js/sidebar.js"></script>