<?php

//database variables
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "ciu_db";

//database creation and connection 
try {
    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
    
        // echo "Database Connected Successfully!";
} catch (Exception) {
    echo("connection failed: " . mysqli_connect_error()."<br>");
       }


//user details from html form
$credentials = $_POST["username"];
$given_password = $_POST["password"];

//declaring other required variables
$correct_password = false;
$response = null;
$firstname=null;
$lastname=null;
$account_exist = false;

//sql select query
try {
  $select_query = "SELECT firstname, lastname, `password`  FROM students WHERE studentno = '$credentials' OR username = '$credentials'";
  $result = mysqli_query($conn,$select_query);
  if (mysqli_num_rows($result) > 0) {
    // output data
    $row = mysqli_fetch_assoc($result);
      $firstname = $row["firstname"];
      $lastname = $row["lastname"];
      $password = $row["password"];

      //an account with the give credentials was found
      $account_exist = true;
    
      //checking for correct password
      if ($given_password == $password){
        $correct_password = true;
      }else{
        $response = "Incorrect credentials! please check login details and try again";
      }
  } else {
    $response = "You do not have an account, you need to create an account!";
  }
} catch (mysqli_sql_exception $e) {
  echo ($e);
}

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="webmail.css" />
    <title>Zimbra web client</title>
  </head>
  <body>
    <div id="background">
      <div id="pane">
        <div id="container">
          <p id="webmail-title">zimbra</p>
          <div>
          <?php if( $account_exist){?>
            <?php if( $correct_password){?>
            <h3><?php echo ("Welcome ". $firstname . " " . $lastname.", you have successfully logged in to your Zimbra Webmail"); ?></h3>
          <?php } else{?>
            <h3><?php echo ($response); ?></h3>
            <?php } ?>
          <?php } else{?>
            <h3><?php echo ($response); ?></h3>
            <?php } ?>
          </div>
          <a href="webmail.html">
          <button id="webmail-btn">Back</button>
          </a>
        </div>
      </div>
      <p class="mail-copyright">
        Copyright © 2005-2023 Synacor, Inc. All rights reserved. "Zimbra" is a
        registered trademark of Synacor, Inc.
      </p>
    </div>
  </body>
</html>
