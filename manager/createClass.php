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
        <title>Document</title>
    </head>

    <body>
        <?php include "../headers/prof_header_home.php"; ?>
        <form action="" method="post">
            <label for="className">Class Name</label>
            <input type="text" name="className" placeholder="class name" required>
            <label for="sem">Class Semester</label>
            <select name="semester" id="">
                <option value="1st Semester">1st Semester</option>
                <option value="2nd Semester">2nd Semester</option>
            </select>
            <label for="year">Year</label>
            <select name="year" id="">
                <?php
                $today = new DateTime("now", new DateTimeZone('Asia/Manila'));
                $dateTime = $today->format('Y');
                $selectedYear = isset($_GET['start']) ? $_GET['start'] : 'start';
                for ($year = $dateTime; $year >= 2000; $year--) {
                    $selected = ($year == $selectedYear) ? 'selected' : '';
                    echo "<option value=\"$year\" $selected>$year</option>";
                }
                ?>
            </select>
            <button type="submit" name="createbtn">Create</button>
        </form>
    </body>

    </html>


    <?php
    if (isset($_POST['createbtn'])) {
        $className = $_POST['className'];
        $semester = $_POST['semester'];
        $year = $_POST['year'];
        $professorID = $_SESSION['professorID'];
        

        $sql = "INSERT INTO `block`(`blockName`, `professorID`, `semester`, `year`) VALUES ('$className','$professorID','$semester','$year')";
        $result = mysqli_query($connect, $sql);
        echo '<script>alert("Block has been created successfully!")</script>';
    }
    ?>

<?php
} else {
    session_destroy();
    echo "<script>alert('Please log in first.')</script>";
    header("Refresh: 3; url='../login/manager-login.php'");
}
?>