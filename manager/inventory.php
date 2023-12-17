<?php
include "../config.php";
session_start();
if (isset($_SESSION['professorID']) && isset($_SESSION['profPassword'])) { ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css files/homepage.css">
        <script src="https://kit.fontawesome.com/979ee355d9.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
            .center {
                text-align: center;
                margin-top: 50px;
            }

            th,
            td {
                text-align: center;
            }

            #logout {
                border: none;
                background-color: white;
                margin-top: 2%;
            }
        </style>
        <title>Capstone Archive</title>
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
                    <a href="professor_home.php" id="selected">Class</a>
                    <a href="submission.php">Submission</a>
                </li>
            </ul>

            <ul>
                <li id="project">
                    <a href="inventory.php"><i class="fa-solid fa-user fa"></i>&nbsp&nbspInventory</a>
                </li>
            </ul>

        </nav>
    </body>

    </html>

<?php
} else {
    session_destroy();
    echo "<script>alert('Please log in first.')</script>";
    header("Refresh: 3; url='../login/manager-login.php'");
}
?>