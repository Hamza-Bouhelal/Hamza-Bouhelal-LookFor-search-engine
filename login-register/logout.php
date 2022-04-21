<?php
ob_start();
session_start();
if($_SESSION['user_id'] != "") {
session_destroy();
unset($_SESSION['user_id']);
unset($_SESSION['user_name']);
unset($_SESSION['user_email']);
unset($_SESSION['user_data']);
unset($_SESSION['loggedin']);
header("Location: http://localhost/lookfor/index.php");
} else {
header("Location: http://localhost/lookfor/index.php");
}
?>