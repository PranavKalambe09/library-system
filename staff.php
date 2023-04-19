<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff</title>
    <link rel="stylesheet" href="css/reset.css?v=<?= $version ?>" />
    <link rel="stylesheet" href="css/index.css?v=<?= $version ?>" />
    <link rel="stylesheet" href="js/index.js?v=<?= $version ?>" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-[url('imgs/reg-body.jpg')]">
    <?php include "src/_nav.php" ?>
    <div class="flex-grow">
    <div class="flex flex-row justify-evenly text-black font-bold">
            <div class="bg-white/70 backdrop-blur-sm py-10 my-12 text-center rounded-2xl scale-75 xl:scale-90 2xl:scale-100">
                <div class="">
                    <img src="imgs/team1.jpg" alt="Jane" class="w-2/3 mx-auto">
                    <div class="containerw3">
                        <h2>Jane Doe</h2>
                        <p class="title">CEO & Founder</p>
                        <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                        <p>example@example.com</p>
                        <p><button class="buttonw3">Contact</button></p>
                    </div>
                </div>
            </div>

            <div class="bg-white/70 backdrop-blur-sm py-10 my-12 text-center rounded-2xl scale-75 xl:scale-90 2xl:scale-100">
                <div class="">
                    <img src="imgs/team2.jpg" alt="Mike" class="w-2/3 mx-auto">
                    <div class="containerw3">
                        <h2>Mike Ross</h2>
                        <p class="title">Art Director</p>
                        <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                        <p>example@example.com</p>
                        <p><button class="buttonw3">Contact</button></p>
                    </div>
                </div>
            </div>

            <div class="bg-white/70 backdrop-blur-sm py-10 my-12 text-center rounded-2xl scale-75 xl:scale-90 2xl:scale-100">
                <div class="">
                    <img src="imgs/team3.jpg" alt="John" class="w-2/3 mx-auto">
                    <div class="containerw3">
                        <h2>John Doe</h2>
                        <p class="title">Designer</p>
                        <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                        <p>example@example.com</p>
                        <p><button class="buttonw3">Contact</button></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'src/_footer.php' ?>
</body>
</html>