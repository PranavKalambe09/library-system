<?php
// Start session
session_start();

// Include configuration file
include 'src/_config.php';

// Set initial values
$insert = false;
$emailErr = $passwordErr = "";
$email = $password = "";

// If user is already logged in, redirect to dashboard page
// if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
//     header("Location: dashboard.php");
//     exit();
// }

// If user is not logged in, check login credentials when form is submitted
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    if (isset($_POST['submit'])) {
        // Check if form has been submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Check for empty email and password fields
            if (empty($_POST["email"])) {
                $emailErr = '<div class="text-yellow-300 text-2xl text-center py-3">Email is required</div>';
            } else if (empty($_POST["password"])) {
                $passwordErr = '<div class="text-yellow-300 text-2xl text-center py-3">Password is required</div>';
            } else {
                // If email and password fields are not empty, check if they match the database
                $email = $_POST['email'];
                $password = $_POST['password'];

                $sql = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'";
                $result = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($result);

                if ($num == 1) {
                    // If credentials match, set session variable and redirect to dashboard page
                    $insert = true;                    
                    $_SESSION['loggedin'] = true;
                    session_write_close(); 
                    header("Refresh:5; url=dashboard_books.php", true, 303);
                } else {
                    // If credentials do not match, display error message
                    echo "<h1> Login failed. Invalid email or password.</h1>";
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
    <title>Login</title>

    <link rel="stylesheet" href="css/reset.css?v=<?= $version ?>" />
    <link rel="stylesheet" href="css/index.css?v=<?= $version ?>" />
    <link rel="stylesheet" href="js/index.js?v=<?= $version ?>" />
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="flex flex-col min-h-screen bg-[url('imgs/reg-body.jpg')]">
    <?php include "src/_nav.php" ?>
    <div class="flex-grow">
        <div class="backdrop-blur-sm bg-white/30 my-6 mx-80 rounded-3xl">
            <form action="login.php" method="post" class="flex flex-col gap-4 py-20 items-center">
                <h2 class="text-xl text-white">Login</h2>
                <input class="w-1/5 rounded-3xl px-10 py-2" type="text" name="email" id="email"
                    placeholder="Enter your email">
                <input class="w-1/5 rounded-3xl px-10 py-2" type="password" name="password" id="password"
                    placeholder="Enter your password">
                <button class="text-black bg-white py-2 rounded-3xl px-5" type="submit" name="submit">Submit</button>
            </form>
            <?php
            //Success message if the form is valid
            if ($insert) {
                echo '<div class="text-white text-center pb-3">Successfully Logged In! Redirecting to Dashboard, Please wait...</div>';
                echo $_SESSION['loggedin'];
                // header("Refresh:5; url=dashboard.php", true, 303);
            
            }
            if (!$insert) {
                echo $emailErr . $passwordErr;
            }
            ?>
        </div>
    </div>
    <?php include 'src/_footer.php' ?>
</body>

</html>