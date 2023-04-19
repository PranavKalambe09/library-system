<?php
// Starting the session
session_start();

// Including the configuration file
include 'src/_config.php';

// Redirecting to login page if the user is not logged in
// if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // header("Location: login.php");
    // exit();
// }

// Deleting a record if the "delete" parameter is set in the URL
if (isset($_GET['delete'])) {
    // Getting the serial number of the record to delete from the URL
    $sno = $_GET['delete'];

    // Deleting the record from the database using the serial number
    $sql = "DELETE FROM `record` WHERE `sno` = $sno";
    $result = mysqli_query($conn, $sql);
}
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
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen bg-[url('imgs/reg-body.jpg')]">
    <?php include "src/_navlog.php" ?>

    <div class="flex-grow">
        <div
            class="books bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-blue-400 to-emerald-400 py-2 px-2 flex justify-center text-center items-center flex-col md:w-8/12 lg:w-10/12 2xl:w-11/12 mx-auto my-6 rounded-2xl">
            <?php include "src/_dash_header.php" ?>

            <table class="table-auto text-white my-12 border-collapse backdrop-blur-sm bg-white/30 rounded-3xl mx-80 "
                id="myTable">
                <thead>
                    <th scope="col" class="mx-4 px-10 py-3 border-b-2 border-slate-300 border-r-2">Name</th>
                    <th scope="col" class="mx-4 px-10 py-3 border-b-2 border-slate-300 border-r-2">Author</th>
                    <th scope="col" class="mx-4 px-10 py-3 border-b-2 border-slate-300 border-r-2">Student Name</th>
                    <th scope="col" class="mx-4 px-10 py-3 border-b-2 border-slate-300 border-r-2">Student ID</th>
                    <th scope="col" class="mx-4 px-10 py-3 border-b-2 border-slate-300 border-r-2">Date Issued</th>
                    <th scope="col" class="mx-4 px-10 py-3 border-b-2 border-slate-300 border-r-2">Return Date</th>
                    <th scope="col" class="mx-4 px-10 py-3 border-b-2 border-slate-300 border-r-2">Phone Number</th>
                    <th scope="col" class="mx-4 px-10 py-3 border-b-2 border-slate-300 border-r-2">Status</th>
                    <th scope="col" class="mx-4 px-10 py-3 border-b-2 border-slate-300">Actions</th>
                </thead>
                <tbody>
                    <?php

                    include 'src/_config.php';
                    $sql = "SELECT * FROM record";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr class="">
                        <td class="px-4 py-1">' . $row["name"] . '</td>
                        <td class="px-4 py-1">' . $row["author"] . '</td>
                        <td class="px-4 py-1">' . $row["student_name"] . '</td>
                        <td class="px-4 py-1">' . $row["sid"] . '</td>
                        <td class="px-4 py-1">' . $row["date"] . '</td>
                        <td class="px-4 py-1">' . $row["return_date"] . '</td>
                        <td class="px-4 py-1">' . $row["number"] . '</td>
                        <td class="px-4 py-1">' . $row["status"] . '</td>
                        <td class="px-4 py-1">
                        <a href="update.php?id='.$row["sno"].' "class="update px-4 py-1 my-2 rounded-3xl text-white bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500 hover:to-yellow-500 mx-2" id=u' . $row['sno'] . '>Update</a>
                        <button class="delete px-4 py-1 my-2 rounded-3xl text-white bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500 hover:to-yellow-500 mx-2" id=d' . $row['sno'] . '>Delete</button></td>
                        </tr>';

                    }
                    ?>
                </tbody>
            </table>


            <script>

                deletes = document.getElementsByClassName('delete');
                Array.from(deletes).forEach((element) => {
                    element.addEventListener("click", (e) => {
                        console.log("edit",);
                        sno = e.target.id.substring(1,);

                        if (confirm("Are you sure you want to delete this note!")) {
                            console.log("yes");
                            window.location = `dashboard_books.php?delete=${sno}`;
                        }
                        else {
                            console.log("no");
                        }
                    })

                });

                edits = document.getElementsByClassName('update');
                Array.from(edits).forEach((element) => {
                    element.addEventListener("click", (e) => {
                        console.log("edit", e);
                        $('#updateModal').modal('toggle');
                    })
                })
            </script>
            <?php include "src/_addBooks.php" ?>
        </div>
    </div>
    <?php include 'src/_footer.php' ?>

</body>

</html>