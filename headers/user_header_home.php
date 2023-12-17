<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css files/homepage.css">
    <title>Document</title>
</head>
<body>
<?php
    if (isset($_POST['logout'])) {
        session_destroy();
        header("Refresh: 1; url='../login/student-login.php'");
        echo "<script>alert('Logged out successfully.')</script>";
    }
    ?>
    <header>
        <div class="top-section">
            <img class="logo" src="../images/psuLogo.svg" alt="PSU Logo">
            <label><b>PANGASINAN</b><span class="university-name"> STATE UNIVERSITY</span></label>

        </div>
        <label for="" id="sys-name"><b>IT CAPSTONE PROJECT INVENTORY</b></label>
        <form action="user_home.php" method="post" class="system-name">
            <button type="submit" name="logout" id="logout"> <img src="../images/power.png" style=" width: 40px; border-radius: 50px; border: none;"></button>
        </form>
    </header>
    <nav class="navi">
        <ul>
            <li id="left-nav">
                <a href="user_home.php" id="selected">Home</a>
                <a href="checker.php">Capstone checker</a>
            </li>
        </ul>

        <ul>
            <li id="project">
                <a href="upload.php"><i class="fa-solid fa-user fa"></i>&nbsp&nbspProject</a>
            </li>
        </ul>

    </nav>
</body>
</html>