<?php 
// include configuration file
include 'src/_config.php';

// check if session is active, and if so, unset and destroy it
if (session_status() == PHP_SESSION_ACTIVE) {
  session_unset();
  session_destroy();
} else { // if session is not active, execute the following code

  // set variables and error messages to empty strings
  $insert = false;
  $nameErr = $emailErr = $numberErr = $passwordErr = $cpasswordErr = "";
  $name = $email = $number = $password = $cpassword = "";

  // include configuration file
  include 'src/_config.php';

  // if form is submitted, execute the following code
  if (isset($_POST['submit'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // define a function to sanitize input data
      function test_input($data)
      {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

      // validate form input and set error messages
      if (empty($_POST["name"])) {
        $nameErr = '<div class="text-yellow-300 text-2xl text-center py-3">Name is required</div>';
      }
      else if (empty($_POST["email"])) {
        $emailErr = '<div class="text-yellow-300 text-2xl text-center py-3">Email is required</div>';
      }
      else if (empty($_POST["number"])) {
        $numberErr = '<div class="text-yellow-300 text-2xl text-center py-3">Number is required</div>';
      }
      else if (empty($_POST["password"])) {
        $passwordErr = '<div class="text-yellow-300 text-2xl text-center py-3">Password is required</div>';
      }
      else if (empty($_POST["cpassword"])) {
        $cpasswordErr = '<div class="text-yellow-300 text-2xl text-center py-3">Type your Password again!</div>';
      } else {
        // if form input is valid, assign values to variables
        $name = $_POST['name'];
        $email = $_POST['email'];
        $number = $_POST['number'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        // check if password and confirm password match
        if ($password != $cpassword) {
          echo "Password mismatch";
        } else {
          // if passwords match, insert user data into database
          $sql = "INSERT INTO `users` (`name`, `email`, `number`, `password`, `created_at`) VALUES ('$name', '$email', '$number', '$password', current_timestamp());";
          $result = mysqli_query($conn, $sql);

          // check if query was successful and set variable to true
          if ($result) {
            $insert = true;
            
          } else { // if query was not successful, print error message
            echo "<p class='text-red-600'>ERROR CONNECTING";
          }
        }
      }
    }
  }

}
// close database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/reset.css?v=<?= $version ?>" />
    <link rel="stylesheet" href="css/index.css?v=<?= $version ?>" />
    <link rel="stylesheet" href="js/index.js?v=<?= $version ?>" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen bg-[url('imgs/reg-body.jpg')]">
    <?php include "src/_nav.php" ?>
    <div class="flex-grow">
        <div class="mx-80 rounded-3xl my-4 justify-center flex-block backdrop-blur-sm bg-white/30">
            <form action="register.php" method="post" class="flex flex-col justify-between mx-2 my-4" id="form">
                <input class="py-2 my-2 rounded-3xl text-center px-10 mx-auto mt-8" type="text" name="name" id="name"
                    placeholder="Enter your Name" autocomplete="off" required/>
                <input class="py-2 my-2 rounded-3xl text-center px-10 mx-auto" type="email" name="email" id="email"
                    placeholder="Enter your Email" autocomplete="off" pattern="[a-z0-9._%+-]+@+[a-z0-9._%+-]" required/>
                <input class="py-2 my-2 rounded-3xl text-center px-10 mx-auto" type="tel" name="number" id="number"
                    pattern="[0-9]{10}" placeholder="Enter your Phone number" autocomplete="off" min="10" max="10"required/>
                <input class="py-2 my-2 rounded-3xl text-center px-10 mx-auto" type="password" name="password"
                    id="password" placeholder="Enter a valid Password" autocomplete="off" required/>
                <input class="py-2 my-2 rounded-3xl text-center px-10 mx-auto" type="password" name="cpassword"
                    id="cpassword" placeholder="Confirm Password" autocomplete="off" required/>
                <button
                    class="py-2 my-2 rounded-3xl px-6 text-white bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500 hover:to-yellow-500 mx-auto font-semibold"
                    type="submit" id="submit" name="submit">Register</button>
            </form>

            <?php
    if ($insert) {
      echo '<div class="text-white text-center pb-3">Successfully Registered! Redirecting to Login Page, Please wait...
      </div>';
      header( "Refresh:5; url=login.php", true, 303);
      
    }
    if (!$insert) {
      echo $nameErr . $emailErr . $numberErr . $passwordErr . $cpasswordErr;
    }
    ?>
    </div>
    </div>
    <?php include 'src/_footer.php' ?>
</body>

</html>