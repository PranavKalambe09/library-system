<?php

session_start();
include 'src/_config.php';

// if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
//     echo $_SESSION['email'];
// } else {
    // The user is not logged in, redirect to the login page
    // header("Location: login.php");
    // exit();
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/reset.css?v=<?= $version ?>" />
    <link rel="stylesheet" href="css/index.css?v=<?= $version ?>" />
    <link rel="stylesheet" href="js/index.js?v=<?= $version ?>" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen bg-[url('imgs/reg-body.jpg')]">
    <?php include "src/_navlog.php" ?>
    <div class="flex-grow">
        <div
            class="books bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-blue-400 to-emerald-400 py-2 px-2 flex justify-center text-center items-center flex-col w-11/12 mx-auto my-6 rounded-2xl">
            <?php include "src/_dash_header.php" ?>

            <table class="table-auto text-white my-4 border-collapse backdrop-blur-sm bg-white/30 rounded-xl px-5 ">
                <thead>
                    <th scope="col" class="mx-4 px-14 py-3 border-b-2 border-slate-300 border-r-2">Name</th>
                    <th scope="col" class="mx-4 px-14 py-3 border-b-2 border-slate-300 border-r-2">Book Id</th>
                    <th scope="col" class="mx-4 px-14 py-3 border-b-2 border-slate-300 border-r-2">Author</th>
                    <th scope="col" class="mx-4 px-14 py-3 border-b-2 border-slate-300 border-r-2">Category</th>
                    <th scope="col" class="mx-4 px-14 py-3 border-b-2 border-slate-300 ">Availabilty</th>
                </thead>
                <tbody>
                    <?php
                    include 'src/_config.php';
                    $sql = "SELECT * FROM library";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr class="">
                        <td class="px-4 py-1">' . $row["b_name"] . '</td>
                        <td class="px-4 py-1">' . $row["b_id"] . '</td>
                        <td class="px-4 py-1">' . $row["b_author"] . '</td>
                        <td class="px-4 py-1">' . $row["b_category"] . '</td>
                        <td class="px-4 py-1">' . $row["availability"] . '</td></tr>';
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include 'src/_footer.php' ?>
</body>

</html>