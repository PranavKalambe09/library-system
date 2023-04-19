<?php
include('src/_config.php');

$update = false;
$b_nameErr = $b_authorErr = $s_nameErr = $sidErr = $s_phoneErr = $statusErr = "";
if (isset($_POST['submit'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["b_name"])) {
            $b_nameErr = '<div class="text-yellow-300 text-2xl text-center py-3">Book Name is required</div>';
        } else if (empty($_POST["b_author"])) {
            $b_authorErr = '<div class="text-yellow-300 text-2xl text-center py-3">Author is required</div>';
        } else if (empty($_POST["s_name"])) {
            $s_nameErr = '<div class="text-yellow-300 text-2xl text-center py-3">Student Name is required</div>';
        } else if (empty($_POST["s_id"])) {
            $sidErr = '<div class="text-yellow-300 text-2xl text-center py-3">Student ID is required</div>';
        } else if (empty($_POST["s_phone"])) {
            $s_phoneErr = '<div class="text-yellow-300 text-2xl text-center py-3">Student Phone Number is required</div>';
        } else if (empty($_POST["status"])) {
            $statusErr = '<div class="text-yellow-300 text-2xl text-center py-3">Status is required</div>';
        } else {
            $record_id = $_POST['record_id'];
            $b_name = $_POST['b_name'];
            $b_author = $_POST['b_author'];
            $s_name = $_POST['s_name'];
            $s_id = $_POST['s_id'];
            $s_phone = $_POST['s_phone'];
            $status = $_POST['status'];

            $sql = "UPDATE `record` SET `name`='$b_name', `author`='$b_author', `student_name`='$s_name', `sid`='$s_id', `number`='$s_phone', `status`='$status' WHERE `sno`='$record_id'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $update = true;
                header("Location: dashboard_books.php");
            } else {
                echo "<p class='text-red-600'>ERROR CONNECTING";
            }
        }
    }
}

if (isset($_GET['id'])) {
    $record_id = $_GET['id'];
    $sql = "SELECT * FROM `record` WHERE `sno`='$record_id'";
    $result = mysqli_query($conn, $sql);
    $record = mysqli_fetch_assoc($result);
}
$statusopp="";
if($record['status']=="Recieved"){
    $statusopp="Not Recieved";
}else{
    $statusopp="Recieved";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css?v=<?= $version ?>" />
    <link rel="stylesheet" href="css/index.css?v=<?= $version ?>" />
    <link rel="stylesheet" href="js/index.js?v=<?= $version ?>" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body class="flex flex-col min-h-screen bg-[url('imgs/reg-body.jpg')]">
    <?php include "src/_nav.php" ?>
    <div class="flex-grow">
    <div class="flex mx-auto rounded-3xl my-4 justify-center backdrop-blur-sm bg-white/30">
        <form action="update.php" method="post" class="flex flex-col" id="form">
            <input type="hidden" name="record_id" value="<?php echo $record['sno']; ?>" />
            <input class="py-2 rounded-3xl text-center px-4 my-6 mx-4" type="text" name="b_name" id="b_name"
                value="<?php echo $record['name']; ?>" autocomplete="off" />
            <?php echo $b_nameErr; ?>
            <input class="py-1 rounded-3xl text-center px-4 my-6 mx-4" type="text" name="b_author" id="b_author"
                value="<?php echo $record['author']; ?>" autocomplete="off" />
            <?php echo $b_authorErr; ?>
            <input class="py-2 rounded-3xl text-center px-4 my-6 mx-4" type="text" name="s_name" id="s_name"
                placeholder="Enter Student Name" autocomplete="off" value="<?php echo $record['student_name']; ?>" />
            <?php echo $s_nameErr; ?>
            <input class="py-2 rounded-3xl text-center px-4 my-6 mx-4" type="text" name="s_id" id="s_id"
                placeholder="Enter Student ID" autocomplete="off" value="<?php echo $record['sid']; ?>" />
            <?php echo $sidErr; ?>
            <input class="py-2 rounded-3xl text-center px-4 my-6 mx-4" type="tel" name="s_phone" id="s_phone"
                placeholder="Enter Phone Number" autocomplete="off" value="<?php echo $record['number']; ?>" />
            <?php echo $s_phoneErr; ?>
            <select class="py-2 rounded-3xl text-center px-4 my-6 mx-4" name="status" id="status">
                <option value="<?php echo $record['status']; ?>"><?php echo $record['status']; ?></option>
                <option value="<?php echo $statusopp ?>"><?php echo $statusopp ?></option>
            </select>
            <?php echo $statusErr; ?>
            <input type="hidden" name="id" value="<?php echo $record['sno']; ?>" />
            <button
                class="my-8 py-2 px-4 rounded-3xl text-white bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500 hover:to-yellow-500 mx-4"
                type="submit" id="submit" name="submit">Update</button>
        </form>
    </div>
</body>

</html>