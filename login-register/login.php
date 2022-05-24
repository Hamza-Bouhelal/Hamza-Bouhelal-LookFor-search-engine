<?php
session_start();
$error_email = "";
$error_pass = "";
require_once "connect.php";
if(isset($_POST['Submit']) && !empty($_POST['Submit'])) {
    $email = strtolower(mysqli_real_escape_string($conn, $_POST['email']));
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '" . $email . "'");
    $row = mysqli_fetch_assoc($result);
    if(isset($row['password'])) {
        if($row['password'] == md5($password)) {
        $_SESSION['loggedin'] = true;
        $_SESSION['user_name'] = $row['name'];
        $_SESSION['user_email'] = $row['email'];
        $_SESSION['user_data'] = $row['data'];
        $_SESSION['user_id'] = $row['uid'];
        header("Location: http://localhost/lookfor/index.php");
        } else {
            $error_pass = "Wrong Password";
        }
    } else {
        $error_email = "No account with that email";
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $error_email = "Please Enter Valid Email";
    }
    if(strlen($password) < 6) {
        $error_pass = "Password must be minimum of 6 characters";
    }  
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - LookFor Search Engine</title>
    <link rel="stylesheet" href="style.css" />
</head>
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

<body>
    <img src="images/title.png" style="top: 15%" onclick="gotoindex()" class="imgtitle" />
    <form class="container form-anticlear" method="POST" action="" >  
        <h3 class="title" style="font-family: 'Open Sans', sans-serif;">LOOKFOR - LOGIN</h3>
        <h3 class="h3">
            EMAIL</h3>
        <input type="email" id="email" name="email" class="inp" required>
        <div class="bar error" <?php if ($error_email===""){?>style="display:none"<?php } ?>>
            <?php echo $error_email; ?>
        </div>
        <h3 class="h3">
            PASSWORD</h3>
        <input type="password" id="password" name="password" class="inp" required>
        <div class="bar error" <?php if ($error_pass===""){?>style="display:none"<?php } ?>>
            <?php echo $error_pass; ?>
        </div>
        <br/>
        <h5 style="padding-left: 50px;color: #555555;font-family: 'Open Sans', sans-serif;">
        Forgot password?  <a href="recovery.php" style="color: #00b4cc; cursor:pointer" class="link">Recover account</a>
        </h5>
        <button type="submit" value="Submit" name="Submit" class="btn">Login</button>
        <h5 style="padding-left: 50px;color: #555555;font-family: 'Open Sans', sans-serif;">
        No Account?  <a href="register.php" class="link">Register</a>
        </h5>
</form>
</body>
<script type="text/javascript" src="app.js"></script>
<script src="https://cdn.jsdelivr.net/gh/akjpro/form-anticlear/base.js"></script>
<script>
    document.getElementById("email").addEventListener("keypress", function(){
        document.getElementsByClassName("bar")[0].style.display = "none";
        document.getElementsByClassName("bar")[1].style.display = "none";
    });
    document.getElementById("password").addEventListener("keypress", function(){
        document.getElementsByClassName("bar")[0].style.display = "none";
        document.getElementsByClassName("bar")[1].style.display = "none";
    });
</script>
</html>