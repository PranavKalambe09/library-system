<?php

// Include necessary files
include 'src/_version.php';
include 'src/_config.php';

// Set initial values
$insert = false;
$book_nameErr = $authorErr = $full_nameErr = $sidErr = "";
$book_name = $author = $full_name = $sid = "";

// Start processing form data if form is submitted
if (isset($_POST['submit'])) {
    // Check if request method is POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // Validate form inputs and show error messages if necessary
        if (empty($_POST["book_name"])) {
            $book_nameErr = '<div class="text-yellow-300 text-2xl text-center py-3">Book Name is required</div>';
        } else if (empty($_POST["author"])) {
            $authorErr = '<div class="text-yellow-300 text-2xl text-center py-3">Author is required</div>';
        } else if (empty($_POST["full_name"])) {
            $full_nameErr = '<div class="text-yellow-300 text-2xl text-center py-3">Name is required</div>';
        } else if (empty($_POST["sid"])) {
            $sidErr = '<div class="text-yellow-300 text-2xl text-center py-3">Student ID is required</div>';
        } else {
            // If form inputs are valid, store input data in variables
            $book_name = $_POST['book_name'];
            $author = $_POST['author'];
            $full_name = $_POST['full_name'];
            $sid = $_POST['sid'];

            // Create SQL query to insert form data into database
            $sql = "INSERT INTO `requests` (`b_name`, `b_author`, `s_name`, `sid`, `created_at`) VALUES ('$book_name', '$author', '$full_name', '$sid', current_timestamp());";
            // Execute SQL query and check if it was successful
            $result = mysqli_query($conn, $sql);

            // Set flag to indicate successful insertion
            if ($result) {
                $insert = true;
            } else {
                // Show error message if insertion failed
                echo "<p class='text-red-600'>ERROR CONNECTING";
            }

        }
    }
}

// Close database connection
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Library Management System</title>

    <link rel="stylesheet" href="css/reset.css?v=<?= $version ?>" />
    <link rel="stylesheet" href="css/index.css?v=<?= $version ?>" />
    <link rel="stylesheet" href="js/index.js?v=<?= $version ?>" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen bg-[url('imgs/reg-body.jpg')]">
    <?php include "src/_nav.php" ?>
    <div class="flex-grow">

        <div class="flex justify-center text-white">
            <p class="bg-gradient-to-r from-cyan-500 to-blue-500 text-center w-1/2 px-6 py-6 rounded-xl my-10">
                <span class="block text-lg"> Welcome to the library! </span>
                Here, you will find a treasure trove of knowledge and entertainment waiting for you to explore. Our
                collection includes thousands of books, ranging from classic literature to modern bestsellers, as well
                as a diverse array of magazines, newspapers, and multimedia resources.

                Whether you are a student looking to research a paper, a bookworm searching for your next favorite read,
                or someone simply seeking a quiet place to relax and unwind, our library has something to offer. Our
                dedicated staff is always on hand to assist you with finding materials, answer questions, and provide
                recommendations.

                We believe that libraries are not only repositories of information, but also vital community resources
                that foster learning, creativity, and personal growth. We invite you to come and experience all that our
                library has to offer, and to become a part of our vibrant community of learners and readers.
            </p>
        </div>
        <div class="rounded-3xl my-2 justify-center flex-block backdrop-blur-sm max-w-xl mx-auto bg-white/30">
            <h1 class="text-white text-center py-2">Request a Book</h1>
            <form action="index.php" method="post" class="flex flex-col justify-between mx-2" id="form">
                <input class="py-2 my-2 rounded-3xl text-center px-10 mx-auto mt-8" type="text" name="book_name"
                    id="book_name" placeholder="Enter Book Name" autocomplete="off" />
                <input class="py-2 my-2 rounded-3xl text-center px-10 mx-auto" type="text" name="author" id="author"
                    placeholder="Enter Book Author" autocomplete="off" />
                <input class="py-2 my-2 rounded-3xl text-center px-10 mx-auto" type="text" name="full_name"
                    id="full_name" placeholder="Enter your Full Name" autocomplete="off" />
                <input class="py-2 my-2 rounded-3xl text-center px-10 mx-auto" type="text" name="sid" id="sid"
                    placeholder="Enter your Student ID" autocomplete="off" />
                <button
                    class="py-2 my-2 rounded-3xl px-6 text-white bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500 hover:to-yellow-500 mx-auto"
                    type="submit" id="submit" name="submit">Submit</button>
            </form>
            <?php
            if ($insert) {
                echo '<div class="text-white text-center pb-3">Successfully Submitted!</div>';

            }
            if (!$insert) {
                echo $book_nameErr . $authorErr . $full_nameErr . $sidErr;
            }
            ?>
        </div>
        <?php include "src/_footer.php" ?>
</body>

</html>