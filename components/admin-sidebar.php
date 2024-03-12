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
            <a href="<?php echo BASE_URL?>/admin/dashboard.php">
                <span class="icon">
                    <i class="fa-solid fa-gauge"></i>
                </span>
                <span class="title">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="<?php echo BASE_URL?>/admin/room_management.php?">
                <span class="icon">
                    <i class="fa-solid fa-people-roof"></i>
                </span>
                <span class="title">Room Management</span>
            </a>
        </li>
        <!-- <li>
            <a href="<?php echo BASE_URL?>/admin/schedule_management.php?">
                <span class="icon">
                    <i class="fa-regular fa-calendar"></i>
                </span>
                <span class="title">Schedule Management</span>
            </a>
        </li> -->
        <li>
            <a href="<?php echo BASE_URL?>/admin/user_management.php?">
                <span class="icon">
                    <i class="fa-solid fa-user-gear"></i>
                </span>
                <span class="title">User Management</span>
            </a>
        </li>
        <!-- <li>
            <a href="<?php //echo BASE_URL?>/admin/course_management.php?">
                <span class="icon">
                    <i class="fa-solid fa-book"></i>
                </span>
                <span class="title">Course Management</span>
            </a>
        </li> -->
        <li>
            <a href="<?php echo BASE_URL?>/admin/class_management.php?">
                <span class="icon">
                    <i class="fa-solid fa-user-graduate"></i>
                </span>
                <span class="title">Class Management</span>
            </a>
        </li>
        <hr>
        <!-- Allow admin to use the system without loggin in with a user account -->
        <li>
            <a href="<?php echo BASE_URL?>/public/rooms.php" id="systemTest">
                <span class="icon">
                    <i class="fa-solid fa-play"></i>
                </span>
                <span class="title">System Test</span>
            </a>
        </li>
        <li>
            <a href="<?php echo BASE_URL?>/includes/logout.php">
                <span class="icon">
                    <i class="fa-solid fa-person-walking-arrow-right"></i>
                </span>
                <span class="title">Log Out</span>
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