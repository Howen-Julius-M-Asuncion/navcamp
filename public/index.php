<?php
    session_start();
    include_once('../config/config.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guestAccount']) && $_POST['guestAccount'] === 'TRUE') {
        $_SESSION['guestAccount'] = TRUE;
        header('Location: '. BASE_URL .'/public/rooms.php');
    }else{
        header('Location: '. BASE_URL .'/public/login.php');
    }
?>