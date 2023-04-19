<?php

session_start();

// if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
//     header("location: login.php");
//     exit;
// }
// else{

include 'src/_config.php';
if (isset($_GET['update'])) {
    $sno = $_GET['update'];
    $sql = "DELETE FROM `books` WHERE `sno` = $sno";
    $result = mysqli_query($conn, $sql);
}
if (isset($_GET['notify'])) {
    $sno = $_GET['notify'];
    $sql = "DELETE FROM `books` WHERE `sno` = $sno";
    $result = mysqli_query($conn, $sql);
}
if (isset($_GET['delete'])) {
    $sno = $_GET['delete'];
    $sql = "DELETE FROM `books` WHERE `sno` = $sno";
    $result = mysqli_query($conn, $sql);
}
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

<body class="flex flex-col min-h-screen">
    <?php include "src/_header.php" ?>
    <?php include "src/_navlog.php" ?>
    <div class="flex-grow">
        <div
            class="books my-6 mx-72 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-blue-400 to-emerald-400 py-2 px-2 rounded-2xl flex justify-center text-center items-center flex-col">
            <h1 class="text-white text-xl py-2">Books Issued</h1>
            <table class="table-auto text-white my-4 border-collapse backdrop-blur-sm bg-white/30 rounded-3xl px-5 ">
                <thead>
                    <th scope="col" class="mx-4 px-20 py-3 border-b-2 border-slate-300 border-r-2">Name</th>
                    <th scope="col" class="mx-4 px-20 py-3 border-b-2 border-slate-300 border-r-2">Author</th>
                    <th scope="col" class="mx-4 px-20 py-3 border-b-2 border-slate-300 border-r-2">Student Name</th>
                    <th scope="col" class="mx-4 px-20 py-3 border-b-2 border-slate-300 border-r-2">Date Issued</th>
                    <th scope="col" class="mx-4 px-20 py-3 border-b-2 border-slate-300">Actions</th>
                </thead>
                <tbody>
                    <?php
                    include 'src/_config.php';
                    $sql = "SELECT * FROM books";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr class="">
                        <td class="px-4 py-2">' . $row["name"] . '</td>
                        <td class="px-4 py-2">' . $row["author"] . '</td>
                        <td class="px-4 py-2">' . $row["student_name"] . '</td>
                        <td class="px-4 py-2">' . $row["date"] . '</td>
                        <td class="px-4 py-2">
                        <button class="update px-4 py-2 my-2 rounded-3xl text-white bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500 hover:to-yellow-500 mx-auto" id=u' . $row['sno'] . '>Update</button>
                        <button class="notify px-4 py-2 my-2 rounded-3xl text-white bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500 hover:to-yellow-500 mx-auto" id=n' . $row['sno'] . '>Notify</button>
                        <button class="delete px-4 py-2 my-2 rounded-3xl text-white bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500 hover:to-yellow-500 mx-auto" id=d' . $row['sno'] . '>Delete</button></td>
                        </tr>';
                    }

                    ?>
                </tbody>
            </table>

        </div>
        <script>

            deletes = document.getElementsByClassName('delete');
            Array.from(deletes).forEach((element) => {
                element.addEventListener("click", (e) => {
                    console.log("edit",);
                    sno = e.target.id.substring(1,);

                    if (confirm("Are you sure you want to delete this note!")) {
                        console.log("yes");
                        window.location = `dashboard.php?delete=${sno}`;
                    }
                    else {
                        console.log("no");
                    }
                })

            });
        </script>

    </div>
    <?php include 'src/_footer.php' ?>
</body>

</html>