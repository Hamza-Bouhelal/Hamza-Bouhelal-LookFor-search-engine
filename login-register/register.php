<?php
    require_once "connect.php";
    $error_email = "";
    $error_pass = "";
    if(isset($_POST['Submit']) && !empty($_POST['Submit'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
       if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $error_email = "Enter a Valid Email";
        }
        else if(strlen($password) < 6) {
        $error_pass = "Password must be a minimum of 6 characters";
        }       
        else  {
            $select = mysqli_query($conn, "SELECT * FROM users WHERE email = '".strtolower($_POST['email'])."'");
            if(mysqli_num_rows($select)) {
                $error_email = "Email already linked to an account";
            }
            else {
            mysqli_query($conn, "INSERT INTO users(name, email ,password) VALUES('" . $name . "', '" . strtolower($email) . "', '" . md5($password) . "')");
            header("Location: login.php");
            mysqli_close($conn);
            }
        }
    }
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register - LookFor Search Engine</title>
    <link rel="stylesheet" href="style.css" />
</head>
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

<body>
    <img src="images/title.png" onclick="gotoindex()" class="imgtitle" />
    <form class="container form-anticlear" method="POST" action="" >         
        <h3 class="title" style="font-family: 'Open Sans', sans-serif;">LOOKFOR - REGISTER</h3>
        <h3 class="h3">
            NAME</h3>
        <input type="text" id="name" name="name" class="inp" required>
        <br />
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
        </br>
        <button type="submit" value="Submit" name="Submit" class="btn2">Register</button>
        <h5 style="padding-left: 50px;color: #555555;font-family: 'Open Sans', sans-serif;">
        Already have an account?  <a href="login.php" class="link">Login</a>
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