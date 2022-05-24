<?php
session_start();
$error_prev_pass = "";
$error_pass = "";
require_once "connect.php";
if (isset($_SESSION["user_id"])){
    $user = $_SESSION["user_id"];
} else {
    header("Location: http://localhost/lookfor/index.php");
}
if(isset($_POST['Submit']) && !empty($_POST['Submit'])) {
    $prevpass = strtolower(mysqli_real_escape_string($conn, $_POST['password']));
    $password = mysqli_real_escape_string($conn, $_POST['newpass']);
    $result = mysqli_query($conn, "SELECT * FROM users Where uid = '" . $user . "'");
    $row = mysqli_fetch_assoc($result);
    if(isset($row['password'])) {
        if($row['password'] == md5($prevpass)) {
            if(strlen($password) < 6) {
                $error_pass = "Password must be minimum of 6 characters";
            } else {
                if($prevpass != $password){
                    mysqli_query($conn, "UPDATE users SET password = '" . md5($password) . "' WHERE uid = '" . $user . "'");
                    header("Location: logout.php");
                    mysqli_close($conn);
                } else {
                    $error_pass = "New pasword matches previous password";
                }
            }
        } else {
            $error_prev_pass = "Wrong Password";
        }
    }
    else {
        header("Location: http://localhost/lookfor/index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Change password - LookFor Search Engine</title>
    <link rel="stylesheet" href="style.css" />
</head>
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

<body>
    <img src="images/title.png" style="top: 15%" onclick="gotoindex()" class="imgtitle" />
    <form class="container form-anticlear" method="POST" action="" >  
        <h3 class="title" style="font-family: 'Open Sans', sans-serif;">LOOKFOR - CHANGE PASSWORD</h3>
        <h3 class="h3">
            PREVIOUS PASSWORD</h3>
        <input type="password" id="password" name="password" class="inp" required>
        <div class="bar error" <?php if ($error_prev_pass===""){?>style="display:none"<?php } ?>>
            <?php echo $error_prev_pass; ?>
        </div>
        <h3 class="h3">
            NEW PASSWORD</h3>
        <input type="password" id="newpass" name="newpass" class="inp" required>
        <div class="bar error" <?php if ($error_pass===""){?>style="display:none"<?php } ?>>
            <?php echo $error_pass; ?>
        </div>
        <br/>
        <br/>
        <br/>
        <button type="submit" value="Submit" name="Submit" class="btn">Submit</button>
    </form>
</body>
<script type="text/javascript" src="app.js"></script>
<script src="https://cdn.jsdelivr.net/gh/akjpro/form-anticlear/base.js"></script>
<script>
    document.getElementById("newpass").addEventListener("keypress", function(){
        document.getElementsByClassName("bar")[0].style.display = "none";
        document.getElementsByClassName("bar")[1].style.display = "none";
    });
    document.getElementById("password").addEventListener("keypress", function(){
        document.getElementsByClassName("bar")[0].style.display = "none";
        document.getElementsByClassName("bar")[1].style.display = "none";
    });
</script>
</html>