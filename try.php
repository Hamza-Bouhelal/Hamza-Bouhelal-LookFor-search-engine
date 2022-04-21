<?php
require_once "OpenAI.php";

require_once "login-register/connect.php";
$result = mysqli_query($conn, "SELECT * FROM users WHERE email = 'bouhaa@gmail.com'");
$row = mysqli_fetch_assoc($result);
$key = $row['name'];
$instance = new OpenAI(secretKey: 'Bearer ' . $key);
/*
 my api key is stored in the db for security purposes
 (as the name of a certain user hhhh) 
 , since it is stored in the database,
 if the project is initiated somewhere else, 
 the chatbot using OpenAI wouldn't work
 */
$prompt = $_GET["prompt"];
$instance->setDefaultEngine("text-davinci-002");
$res = $instance->complete(
 $prompt,
 100,
 [
 "stop" => ["\n"],
 "temperature" => 0,
 "frequency_penalty" => 0,
 "presence_penalty" => 0,
 "max_tokens" => 200,
 "top_p" => 1
 ]
);
echo $res;
?>