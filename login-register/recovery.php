<?php
session_start();
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
    <div class="container2 form-anticlear">  
        <h3 class="title" style="font-family: 'Open Sans', sans-serif;">LOOKFOR - PASSWORD RECOVERY</h3>
        <h3 class="h3">
            EMAIL</h3>
        <input type="email" id="email" name="email" class="inp" required>
        <br/>
        <br/>
        <div id="emerror" class="bar error" style="display:none"></div>
        <br/>
        <button onclick="final_send(document.getElementById('email').value);" class="btn">Send Email</button>
        <h5 style="padding-left: 50px;color: #555555;font-family: 'Open Sans', sans-serif;">
        Just remembered it?  <a href="login.php" class="link">Login</a>
        </h5>
</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="app.js"></script>
<script src="https://cdn.jsdelivr.net/gh/akjpro/form-anticlear/base.js"></script>
<script src="js/md5.min.js"></script>
<script>
    document.getElementById("email").addEventListener("keypress", function(){
        document.getElementsByClassName("bar")[0].style.display = "none";
    });

    function final_send(email) {
      function hashAsync(algo, str) {
        return crypto.subtle.digest(algo, new TextEncoder("utf-8").encode(str)).then(buf => {
          return Array.prototype.map.call(new Uint8Array(buf), x=>(('00'+x.toString(16)).slice(-2))).join('');
        });
      }
      $.ajax({
        url: "checkemail.php?email=" + email,
      }).done(function (user) {
        if (user == "has_account") {
          hashAsync("SHA-256", email.toLowerCase()).then(encry => {

            console.log(encry);
            var temp =
            '{"from":{"name":"Lookfor"},"to":{"name":"' +
            "Lookfor user" +
            '","address":"' +
            email +
            '"},"subject":"LookFor password recovery","message":"Link to recover account: http://localhost/lookfor/login-register/finalRec.php?arg=' +
            encry +
            '","show_noreply_warning":true}';
          const options = {
            method: "POST",
            headers: {
              "content-type": "application/json",
              "X-RapidAPI-Host": "easymail.p.rapidapi.com",
              "X-RapidAPI-Key":
                "f678c8d3f8msh9cd8d489ddef6ecp1136c9jsn0446d3ea17fc",
            },
            body: temp,
          };
          fetch("https://easymail.p.rapidapi.com/send", options)
            .then((response) => response.json())
            .then((response) =>{
              if(response["success"]){
                alert("Email sent successfully! Go check your account");
              }
              else{
                alert("couldn't send email");
              }
            })
            .catch((err) => alert("couldn't send email"));
          });
          
        } else {
          document.getElementById("emerror").style.display = "block";
          document.getElementById("emerror").innerHTML =
            "No account with that email";
        }
  });
}

</script>
</html>