<?php
    require_once "connect.php";
    $email = $_GET['email'];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '" . $email . "'");
    $row = mysqli_fetch_assoc($result);
    if(isset($row['uid'])) {
        echo "has_account";
    } else {
        echo "no_account";
    }
?>