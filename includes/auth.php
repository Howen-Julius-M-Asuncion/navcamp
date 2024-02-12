<?php
include_once('../config/dbcon.php');
include_once '../config/config.php';

session_start();
$username = $_POST['username']; 
$password = $_POST['password'];

$sqlLogin = "SELECT * FROM account_admin as admin WHERE admin.username='{$username}' and admin.password='{$password}'";
$result = $conn->query($sqlLogin);

// Check if the account is admin, if it is then continue to admin dashboard 
if($result->num_rows>0){
	$_SESSION['active']="TRUE";
	while($rowUser=$result->fetch_assoc()){
		$_SESSION['activeAdmin']="TRUE";
		header('Location: '. BASE_URL .'/admin/dashboard.php');
	}
	$_SESSION['active']="TRUE";	
}else{
    // If the account is not an admin, then look for user table
    $sqlLogin = "SELECT * FROM account_user as user WHERE user.username='{$username}' and user.password='{$password}'";
    $result = $conn->query($sqlLogin);
    if($result->num_rows>0){
        $_SESSION['active']="TRUE";
        while($rowUser=$result->fetch_assoc()){
            if($rowUser['user_type'] == 1){
                header('Location: '. BASE_URL .'/public/map.php');
            }elseif($rowUser['user_type'] == 1){
                header('Location: '. BASE_URL .'/public/map.php');
            }
        }
    }else{
        $_SESSION["error_message"]= "Invalid Username or Password!";
        header('Location: '. BASE_URL .'/public/login.php');
    }
}
?>
