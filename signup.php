<?php

//database variables
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ciu_db";

//database creation and connection 
try {
    $conn = mysqli_connect($servername, $username, $password, $dbname);
        // echo "Database Connected Successfully!";
} catch (Exception) {
    echo("First connection failed: " . mysqli_connect_error()."<br>");
        $conn = mysqli_connect($servername, $username, $password);
        if (!$conn) {
            die("Second connection failed: " . mysqli_connect_error());
        }    
        if (mysqli_query($conn, "CREATE DATABASE ciu_db")) {
        echo "Database created successfully";
      } else {
        die("Error creating database: " . mysqli_error($conn));
      }
      mysqli_close($conn);
      try {
        $conn = mysqli_connect($servername, $username, $password, $dbname);
            echo "<br>Database Connected Successfully!";
      } catch (Exception) {
        die("Database Connection Failed: " . mysqli_connect_error());
      }
    $sql = "CREATE TABLE students (
        `studentno` INT(11) UNSIGNED PRIMARY KEY,
        `firstname` VARCHAR(25) NOT NULL,
        `lastname` VARCHAR(25) NOT NULL,
        `username` VARCHAR(30) UNIQUE NOT NULL,
        `password` VARCHAR(20) NOT NULL
        )";
        try {
            mysqli_query($conn, $sql);
            echo "<br>Students table created successfully";
        } catch (Exception) {
            echo "<br>Error creating table: " . mysqli_error($conn);
        }
}

//generating random student number with the specified range
$student_no = rand(22000000,22399999);
//user details from html form
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$username = $_POST["username"];
$password = $_POST["password"];
$success = null;
$duplicate = null;

//insertion sql query
try {
  $insert_query = "INSERT INTO `students` VALUES('$student_no','$firstname','$lastname','$username','$password')";
  $success = mysqli_query($conn,$insert_query);
} catch (mysqli_sql_exception $e) {
  echo ($e);
  //checking for duplicate username error
  $duplicate = stristr($e,"Duplicate");
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="sis.css" />
    <title>CIU |</title>
  </head>
  <body>
    <div id="background">
      <div id="pane">
        <div style="height: 430px; top: 40px" id="container">
          <div id="header">
            <a href="#">
              <img
                id="header-image"
                src="./images/sis-header-image.jpg"
                alt=""
              />
            </a>
          </div>
          <?php if( $success){?>
          <h3>
            <?php echo("Congratulations ".$firstname." you have successfully created an account, your Student no is: ". $student_no . "<br> You can either login with your Student number or Username"); ?>
          </h3>
          <?php } else{?>
            <h3><?php echo ("Error occured while creating account..."); ?></h3>
            <?php if( $duplicate){?>
            <h3><?php echo ("Duplicate record found, you already have an account!"); ?></h3>
            <?php } ?>
            <?php } ?>
          <a href="signup.html">
            <button class="sis-btn">
              Back
              <img
              style="transform: rotate(180deg); margin-top: 6px; height: 15px"
                class="sis-btn-icon"
                src="./images/sign-up-arrow.svg"
                alt=""
              />
            </button>
          </a>
          <div id="footer">
            <p class="sis-copyright link-simulation">
              <small id="c-tag">©</small> Cyprus International University
            </p>
            <p class="sis-copyright">All Rights Reserved</p>
            <p class="sis-copyright">2023</p>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
