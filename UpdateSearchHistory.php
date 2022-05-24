<?php 
    session_start();
    require_once "login-register/connect.php";
    $user_id = $_GET['user_id'];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE uid = '" . $_SESSION['user_id'] . "'");        
    $row = mysqli_fetch_assoc($result);
    $query = $_GET["query"];
    $_SESSION['user_data'] = $_SESSION['user_data'] . "*-sep-*" . $query;
    $update = mysqli_query($conn, "UPDATE users SET data = '" . $_SESSION['user_data'] . "' WHERE uid = '" . $user_id . "'");
?>