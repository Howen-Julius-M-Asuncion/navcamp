<?php
include_once '../config/config.php';

session_abort();
header('Location: '. BASE_URL .'/public/login.php');
?>