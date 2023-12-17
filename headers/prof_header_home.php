<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
if (isset($_POST['logout'])) {
    session_destroy();
    header("Refresh: 1; url='../login/manager-login.php'");
    echo "<script>alert('Logged out successfully.')</script>";
}
?>

<body>
    <header>
        <div class="top-section">
            <img class="logo" src="../images/psuLogo.svg" alt="PSU Logo">
            <label><b>PANGASINAN</b><span class="university-name"> STATE UNIVERSITY</span></label>

        </div>
        <label for="" id="sys-name"><b>IT CAPSTONE PROJECT INVENTORY</b></label>
        <form action="" method="post" class="system-name">
            <button type="submit" name="logout" id="logout"> <img src="../images/power.png" style=" width: 40px; border-radius: 50px; border: none;"></button>
        </form>
    </header>
    <nav class="navi">
        <ul>
            <li id="left-nav">
                <a href="../manager/professor_home.php" id="selected">Class</a>
                <a href="../manager/submission.php">Submission</a>
            </li>
        </ul>

        <ul>
            <li id="project">
                <a href="../manager/inventory.php"><i class="fa-solid fa-user fa"></i>&nbsp&nbspInventory</a>
            </li>
        </ul>

    </nav>
</body>

</html>