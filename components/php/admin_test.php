<?php
    include_once('../config/dbcon.php');
    include_once ('../config/config.php');

    session_start();

    if ($result->num_rows > 0) {
        $_SESSION['active']="TRUE";
        $user = $result->fetch_assoc();
        $user_id = $user['id'];
        
        // Check if the user is an admin
        $sqlAdminLogin = "SELECT * FROM admins WHERE user_id = '{$user_id}'";
        $resultAdmin = $conn->query($sqlAdminLogin);
        
        if ($resultAdmin->num_rows > 0) {
            $_SESSION['admin']="TRUE";
            header('Location: '. BASE_URL .'/admin/dashboard.php');
        } else {

            // Check if the user is a teacher
            $sqlFacultyLogin = "SELECT * FROM faculty WHERE user_id = '{$user_id}'";
            $resultFaculty = $conn->query($sqlFacultyLogin);

            if ($resultFaculty->num_rows > 0) {
                $_SESSION['faculty']="TRUE";
                header('Location: '. BASE_URL .'/public/rooms.php');
            } else {

                // Check if the user is a student
                $sqlStudentLogin = "SELECT * FROM students WHERE user_id = '{$user_id}'";
                $resultStudent = $conn->query($sqlStudentLogin);

                if ($resultStudent->num_rows > 0) {
                    $_SESSION['student']="TRUE";
                    header('Location: '. BASE_URL .'/public/rooms.php');
                } else {
                    $_SESSION["error_message"]= "User is not assigned!";
                    header('Location: '. BASE_URL .'/public/login.php');
                }
            }
        }
    } else {
        $_SESSION["error_message"]= "Invalid Username or Password!";
        session_abort();
        header('Location: '. BASE_URL .'/public/login.php');
    }
?>
