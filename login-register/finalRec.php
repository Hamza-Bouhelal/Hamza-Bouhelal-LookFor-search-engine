<?php
session_start();
$error_pass = "";
if(!isset($_GET['arg'])){
    header("Location: http://localhost/login-register/login.php");
}
require_once "connect.php";
if(isset($_POST['Submit']) && !empty($_POST['Submit'])) {
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    if(strlen($password)>=6){
    #split current directory at substring ?arg=
    $arg = $_GET['arg'];
    echo '<script type="text/javascript">console.log("'.$arg.'");</script>';
    $result = mysqli_query($conn, "SELECT * FROM users");
    while($row = mysqli_fetch_assoc($result)){
        if(hash('sha256',strtolower($row["email"])) === $arg){
            mysqli_query($conn, "UPDATE users SET password = '" . md5($password) . "' WHERE email = '" . $row["email"] . "'");
            header("Location: http://localhost/lookfor/login-register/login.php");
        }
    }
    #header("Location: http://localhost/lookfor/index.php");
    }else{
        $error_pass = "Password must be minimum of 6 characters";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Recovery - LookFor Search Engine</title>
    <link rel="stylesheet" href="style.css" />
</head>
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

<body>
    <img src="images/title.png" style="top: 15%" onclick="gotoindex()" class="imgtitle" />
    <form class="container2 form-anticlear" method="POST" action="" >  
        <h3 class="title" style="font-family: 'Open Sans', sans-serif;">LOOKFOR - PASSWORD RECOVERY</h3>
        <h3 class="h3">
            NEW PASSWORD</h3>
        <input type="password" id="password" name="password" class="inp" required>
        <br/>
        <div class="bar error" <?php if ($error_pass===""){?>style="display:none"<?php } ?>>
            <?php echo $error_pass; ?>
        </div>
        <?php if ($error_pass!==""){?><br/><?php } ?>
        <br/>
        <button type="submit" value="Submit" name="Submit" class="btn">Change Password</button>
</form>
</body>
<script type="text/javascript" src="app.js"></script>
<script src="https://cdn.jsdelivr.net/gh/akjpro/form-anticlear/base.js"></script>
<script>
    document.getElementById("password").addEventListener("keypress", function(){
        document.getElementsByClassName("bar")[0].style.display = "none";
    });
</script>
</html>